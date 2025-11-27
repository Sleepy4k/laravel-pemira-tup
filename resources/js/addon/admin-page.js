document.addEventListener("DOMContentLoaded", function () {
    const headers = document.querySelector("header[data-debug][data-routes]");
    if (headers) {
        const isDebug = headers.getAttribute("data-debug") === "true";
        const routes = JSON.parse(headers.getAttribute("data-routes") || "{}");

        new OffcanvasHandler({
            debug: isDebug,
            tableId: "#admin-table",
            routes: routes,
            offcanvas: {
                add: {
                    id: "#add-new-record",
                    triggerBtnId: "#add-new-record-btn",
                },
                show: {
                    id: "#show-record",
                    fieldMap: {
                        name: "#show-name",
                        username: "#show-username",
                        created_at: "#show-created-at",
                        updated_at: "#show-last-updated",
                    },
                    fieldMapBehavior: {},
                },
                edit: {
                    id: "#edit-record",
                    fieldMap: {
                        name: "#edit-name",
                        username: "#edit-username",
                    },
                    fieldMapBehavior: {},
                },
            },
        });
    }
});
