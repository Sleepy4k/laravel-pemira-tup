document.addEventListener("DOMContentLoaded", function () {
    const headers = document.querySelector("header[data-debug][data-routes]");
    if (headers) {
        const isDebug = headers.getAttribute("data-debug") === "true";
        const routes = JSON.parse(headers.getAttribute("data-routes") || "{}");

        function convertToDatetimeLocal(dateStr) {
            const date = new Date(dateStr);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, "0");
            const day = String(date.getDate()).padStart(2, "0");
            const hours = String(date.getHours()).padStart(2, "0");
            const minutes = String(date.getMinutes()).padStart(2, "0");
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }

        new OffcanvasHandler({
            debug: isDebug,
            tableId: "#timeline-table",
            routes: routes,
            offcanvas: {
                add: {
                    id: "#add-new-record",
                    triggerBtnId: "#add-new-record-btn",
                },
                show: {
                    id: "#show-record",
                    fieldMap: {
                        start_date: "#show-start-date",
                        end_date: "#show-end-date",
                        name: "#show-name",
                        description: "#show-description",
                        icon: "#show-box-icon",
                        range: "#show-range",
                        created_at: "#show-created-at",
                        updated_at: "#show-last-updated",
                    },
                    fieldMapBehavior: {
                        start_date: function (el, data, rowData) {
                            el.text(new Date(data).toLocaleString());
                        },
                        end_date: function (el, data, rowData) {
                            el.text(new Date(data).toLocaleString());
                        },
                        icon: function (el, data, rowData) {
                            document.getElementById("show-box-icon").innerHTML = `<box-icon name="${data}" color="#0b515c" size="md"></box-icon>`;
                        },
                    },
                },
                edit: {
                    id: "#edit-record",
                    fieldMap: {
                        start_date: "#edit_start_date",
                        end_date: "#edit_end_date",
                        name: "#edit_name",
                        description: "#edit_description",
                        icon: "#edit_icon",
                        range: "#edit_range",
                    },
                    fieldMapBehavior: {
                        start_date: function (el, data, rowData) {
                            document.getElementById("edit_start_date").value = convertToDatetimeLocal(data);
                        },
                        end_date: function (el, data, rowData) {
                            document.getElementById("edit_end_date").value = convertToDatetimeLocal(data);
                        },
                        icon: function (el, data, rowData) {
                            document.getElementById("edit_icon").value = data || '';
                        },
                    },
                },
            },
        });
    }
});
