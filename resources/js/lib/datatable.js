import $ from 'jquery';
window.$ = window.jQuery = $;

import DataTable from 'datatables.net-dt';
import 'datatables.net-buttons-dt';
import 'datatables.net-responsive-dt';

(function ($, DataTable) {
    var _getVisibleColumns = function () {
        var visible_columns = [];
        $.each(DataTable.settings[0].aoColumns, function (index, column) {
            if (column.bVisible) {
                visible_columns.push(column);
            }
        });

        return visible_columns;
    };

    var _buildParams = function (dt, action, onlyVisibles) {
        var params = dt.ajax.params();
        params.action = action;
        params._token = $('meta[property="csrf-token"]').attr('content') || '';

        if (onlyVisibles) {
            params.visible_columns = _getVisibleColumns();
        } else {
            params.visible_columns = null;
        }

        return params;
    }

    var _downloadFromUrl = function (url, params) {
        var postUrl = url + '/export';
        var xhr = new XMLHttpRequest();
        xhr.open('POST', postUrl, true);
        xhr.responseType = 'arraybuffer';
        xhr.onload = function () {
            if (this.status === 200) {
                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }
                var type = xhr.getResponseHeader('Content-Type');

                var blob = new Blob([this.response], {type: type});
                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                    window.navigator.msSaveBlob(blob, filename);
                } else {
                    var URL = window.URL || window.webkitURL;
                    var downloadUrl = URL.createObjectURL(blob);

                    if (filename) {
                        var a = document.createElement("a");
                        if (typeof a.download === 'undefined') {
                            window.location = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                        }
                    } else {
                        window.location = downloadUrl;
                    }

                    setTimeout(function () {
                        URL.revokeObjectURL(downloadUrl);
                    }, 100);
                }
            }
        };

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[property="csrf-token"]').attr('content') || '');
        xhr.send(params);
    };

    var _buildUrl = function(dt, action) {
        var url = dt.ajax.url() || '';
        var params = dt.ajax.params();
        params.action = action;

        if (url.indexOf('?') > -1) {
            return url + '&' + $.param(params);;
        }

        return url + '?' + $.param(params);
    };

    DataTable.ext.buttons.excel = {
        className: 'buttons-excel',
        text: function (dt) {
            return '<box-icon name="file-blank" type="solid" class="w-6 h-6"></box-icon> Excel';
        },
        action: function (e, dt, node, config) {
            var url = _buildUrl(dt, 'excel');
            window.location = url;
        }
    };

    DataTable.ext.buttons.postExcel = {
        className: 'buttons-excel',
        text: function (dt) {
            return '<box-icon name="file-blank" type="solid" class="w-6 h-6"></box-icon> Excel';
        },
        action: function (e, dt, node, config) {
            var url = dt.ajax.url() || window.location.href;
            var params = _buildParams(dt, 'excel');

            _downloadFromUrl(url, $.param(params));
        }
    };

    DataTable.ext.buttons.postExcelVisibleColumns = {
        className: 'buttons-excel',

        text: function (dt) {
            return '<box-icon name="file-blank" type="solid" class="w-6 h-6"></box-icon> Excel (only visible columns)';
        },

        action: function (e, dt, button, config) {
            var url = dt.ajax.url() || window.location.href;
            var params = _buildParams(dt, 'excel', true);

            _downloadFromUrl(url, params);
        }
    };

    DataTable.ext.buttons.export = {
        extend: 'collection',

        className: 'buttons-export',

        text: function (dt) {
            return `<box-icon name="download" class="w-6 h-6"></box-icon>
                Export `;
        },

        buttons: ['csv', 'excel', 'pdf'],
    };

    DataTable.ext.buttons.csv = {
        className: 'buttons-csv',

        text: function (dt) {
            return '<box-icon name="file-blank" type="solid" class="w-6 h-6"></box-icon> CSV';
        },

        action: function (e, dt, button, config) {
            var url = _buildUrl(dt, 'csv');
            window.location = url;
        }
    };

    DataTable.ext.buttons.postCsvVisibleColumns = {
        className: 'buttons-csv',

        text: function (dt) {
            return '<box-icon name="file-blank" type="solid" class="w-6 h-6"></box-icon> CSV (only visible columns)';
        },

        action: function (e, dt, button, config) {
            var url = dt.ajax.url() || window.location.href;
            var params = _buildParams(dt, 'csv', true);

            _downloadFromUrl(url, params);
        }
    };

    DataTable.ext.buttons.postCsv = {
        className: 'buttons-csv',

        text: function (dt) {
            return '<box-icon name="file-blank" type="solid" class="w-6 h-6"></box-icon> CSV';
        },

        action: function (e, dt, button, config) {
            var url = dt.ajax.url() || window.location.href;
            var params = _buildParams(dt, 'csv');

            _downloadFromUrl(url, params);
        }
    };

    DataTable.ext.buttons.pdf = {
        className: 'buttons-pdf',

        text: function (dt) {
            return '<box-icon name="file-pdf" type="solid" class="w-6 h-6"></box-icon> PDF';
        },

        action: function (e, dt, button, config) {
            var url = _buildUrl(dt, 'pdf');
            window.location = url;
        }
    };

    DataTable.ext.buttons.postPdf = {
        className: 'buttons-pdf',

        text: function (dt) {
            return '<box-icon name="file-pdf" type="solid" class="w-6 h-6"></box-icon> PDF';
        },

        action: function (e, dt, button, config) {
            var url = dt.ajax.url() || window.location.href;
            var params = _buildParams(dt, 'pdf');

            _downloadFromUrl(url, params);
        }
    };

    DataTable.ext.buttons.print = {
        className: 'buttons-print',

        text: function (dt) {
            return  '<box-icon name="printer" type="solid" class="w-6 h-6"></box-icon> ' + dt.i18n('buttons.print', 'Print');
        },

        action: function (e, dt, button, config) {
            var url = _buildUrl(dt, 'print');
            window.open(url, '_blank');
        }
    };

    DataTable.ext.buttons.reset = {
        className: 'buttons-reset',

        text: function (dt) {
            return '<box-icon name="undo" class="w-6 h-6"></box-icon> ' + dt.i18n('buttons.reset', 'Reset');
        },

        action: function (e, dt, button, config) {
            dt.search('');
            dt.columns().search('');
            dt.draw();
        }
    };

    DataTable.ext.buttons.reload = {
        className: 'buttons-reload',

        text: function (dt) {
            return '<box-icon name="refresh" class="w-6 h-6"></box-icon> ' + dt.i18n('buttons.reload', 'Reload');
        },

        action: function (e, dt, button, config) {
            dt.draw(false);
        }
    };

    DataTable.ext.buttons.create = {
        className: 'buttons-create',

        text: function (dt) {
            return '<box-icon name="plus" class="w-6 h-6"></box-icon> ' + dt.i18n('buttons.create', 'Create');
        },

        action: function (e, dt, button, config) {
            window.location = window.location.href.replace(/\/+$/, "") + '/create';
        }
    };

    if (typeof DataTable.ext.buttons.copyHtml5 !== 'undefined') {
        $.extend(DataTable.ext.buttons.copyHtml5, {
            text: function (dt) {
                return '<box-icon name="copy" type="solid" class="w-6 h-6"></box-icon> ' + dt.i18n('buttons.copy', 'Copy');
            }
        });
    }

    if (typeof DataTable.ext.buttons.colvis !== 'undefined') {
        $.extend(DataTable.ext.buttons.colvis, {
            text: function (dt) {
                return '<box-icon name="eye" class="w-6 h-6"></box-icon> ' + dt.i18n('buttons.colvis', 'Column visibility');
            }
        });
    }
})(jQuery, DataTable);
