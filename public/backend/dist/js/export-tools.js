(function ($) {
    function cleanText(value) {
        return String(value || '')
            .replace(/\s+/g, ' ')
            .replace(/\$?\s+/g, ' ')
            .trim();
    }

    function cellText(cell) {
        var $cell = $(cell);
        var selected = $cell.find('select option:selected').first();

        if (selected.length) {
            return cleanText(selected.text());
        }

        var exportValue = $cell.find('[data-export-value]').first();

        if (exportValue.length) {
            return cleanText(exportValue.data('export-value'));
        }

        return cleanText($cell.text());
    }

    function filename(value) {
        return cleanText(value).toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '') || 'reporte';
    }

    function rowData(table, row) {
        var headers = [];
        var values = [];

        $(table.table().header()).find('th').each(function (index) {
            if ($(this).hasClass('no-export')) {
                return;
            }

            headers.push(cleanText($(this).text()));
            values.push(cellText($(row).children('td').eq(index)));
        });

        return { headers: headers, values: values };
    }

    function buildPdfButton(table, title, row) {
        return $('<button type="button" class="btn btn-sm btn-danger ml-1 js-row-pdf" title="Generar PDF">' +
            '<i class="fas fa-file-pdf"></i>' +
        '</button>').on('click', function () {
            var data = rowData(table, row);
            var id = data.values[0] || 'registro';

            pdfMake.createPdf({
                pageSize: 'A4',
                pageOrientation: 'portrait',
                content: [
                    { text: title, style: 'title' },
                    { text: 'Fecha de generacion: ' + new Date().toLocaleString('es-CO'), style: 'date' },
                    {
                        table: {
                            widths: ['35%', '65%'],
                            body: data.headers.map(function (header, index) {
                                return [
                                    { text: header, bold: true, fillColor: '#f2f2f2' },
                                    data.values[index] || 'N/A'
                                ];
                            })
                        }
                    }
                ],
                styles: {
                    title: { fontSize: 18, bold: true, alignment: 'center', margin: [0, 0, 0, 12] },
                    date: { fontSize: 10, alignment: 'right', margin: [0, 0, 0, 12] }
                },
                defaultStyle: { fontSize: 11 }
            }).download(filename(title) + '-' + filename(id) + '.pdf');
        });
    }

    function attachRowPdfButtons(table, title) {
        table.rows({ page: 'current' }).every(function () {
            var row = this.node();
            var actionCell = $(row).children('td').last();

            if (!actionCell.find('.js-row-pdf').length) {
                actionCell.append(buildPdfButton(table, title, row));
            }
        });
    }

    window.initExportableDataTable = function (selector, title) {
        var options = $.extend(true, {}, window.dataTableEs, {
            dom: "<'row mb-2'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel mr-1"></i> Excel general',
                    className: 'btn btn-success btn-sm',
                    title: title,
                    filename: filename(title) + '-general',
                    exportOptions: {
                        columns: ':not(.no-export)',
                        modifier: { search: 'none', order: 'applied' },
                        format: {
                            body: function (data, row, column, node) {
                                return cellText(node);
                            }
                        }
                    }
                }
            ]
        });

        var table = $(selector).DataTable(options);
        attachRowPdfButtons(table, title);
        table.on('draw', function () {
            attachRowPdfButtons(table, title);
        });

        return table;
    };
})(jQuery);
