document.addEventListener("DOMContentLoaded", function () {
    const csrfToken =
        document
            .querySelector('meta[property="csrf-token"]')
            .getAttribute("content") || "";

    function showNotification(message, type = "success") {
        if (typeof window.Toast !== "undefined") {
            window.Toast.fire({
                icon: type,
                title: message,
            });
        } else {
            alert(message);
        }
    }

    const headers = document.querySelector(
        "header[data-debug][data-routes][data-import-url][data-send-notification-url][data-send-bulk-notification-url]"
    );
    if (headers) {
        const isDebug = headers.getAttribute("data-debug") === "true";
        const routes = JSON.parse(headers.getAttribute("data-routes") || "{}");

        new OffcanvasHandler({
            debug: isDebug,
            tableId: "#voter-table",
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
                        email: "#show-email",
                        batch_id: "#show-batch",
                        voted_at: "#show-voted-at",
                        created_at: "#show-created-at",
                        updated_at: "#show-last-updated",
                    },
                    fieldMapBehavior: {
                        batch_id: function (el, data, rowData) {
                            el.text(rowData.batch.name || data);
                        },
                        voted_at: function (el, data, rowData) {
                            if (data) {
                                el.text(new Date(data).toLocaleString());
                            } else {
                                el.text("Belum Memilih");
                            }
                        },
                    },
                },
                edit: {
                    id: "#edit-record",
                    fieldMap: {
                        name: "#edit-name",
                        email: "#edit-email",
                        batch_id: "#edit-batch_id",
                    },
                    fieldMapBehavior: {
                        batch_id: function (el, data, rowData) {
                            el.val(data).trigger("change");
                        },
                    },
                },
            },
        });

        const voterTable = window.NakaDataTables["voter-table"];
        const sendNotificationUrl =
            headers.getAttribute("data-send-notification-url") || "";

        voterTable.on("draw.dt", function () {
            const sendNotificationBtn = document.querySelectorAll(
                ".send-notification-btn"
            );

            sendNotificationBtn.forEach((btn) => {
                if (typeof window.Swal !== "undefined") {
                    btn.addEventListener("click", function (e) {
                        e.preventDefault();
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You are about to send notification to this voter.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#F98825",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, send it!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                axios
                                    .post(
                                        sendNotificationUrl.replace(
                                            ":id",
                                            btn.getAttribute("data-id")
                                        ),
                                        {},
                                        {
                                            headers: {
                                                "X-CSRF-TOKEN": csrfToken,
                                                Accept: "application/json",
                                            },
                                        }
                                    )
                                    .then((response) => {
                                        return response.data;
                                    })
                                    .then((data) => {
                                        showNotification(
                                            data.message,
                                            "success"
                                        );
                                    })
                                    .catch((error) => {
                                        showNotification(
                                            "Failed to send notification." +
                                                error.message,
                                            "error"
                                        );
                                    });
                            }
                        });
                    });
                } else {
                    showNotification("SweetAlert2 is not loaded.", "error");
                }
            });
        });

        const bulkSendNotificationBtn = document.getElementById(
            "bulk-send-notification-btn"
        );
        const sendBulkNotificationUrl =
            headers.getAttribute("data-send-bulk-notification-url") || "";

        bulkSendNotificationBtn.addEventListener("click", function () {
            if (typeof window.Swal !== "undefined") {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You are about to send notifications to all voters.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#F98825",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, send them!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .post(
                                sendBulkNotificationUrl,
                                {},
                                {
                                    headers: {
                                        "X-CSRF-TOKEN": csrfToken,
                                        Accept: "application/json",
                                    },
                                }
                            )
                            .then((response) => {
                                return response.data;
                            })
                            .then((data) => {
                                showNotification(data.message, "success");
                            })
                            .catch((error) => {
                                showNotification(
                                    "Failed to send notifications." +
                                        error.message,
                                    "error"
                                );
                            });
                    }
                });
            } else {
                showNotification("SweetAlert2 is not loaded.", "error");
            }
        });

        const importUrl = headers.getAttribute("data-import-url") || "";

        if (typeof window.Swal !== "undefined") {
            const importBtn = document.getElementById("import-btn");
            importBtn.addEventListener("click", function () {
                Swal.fire({
                    title: "Input Voters Data",
                    input: "file",
                    inputLabel: "Upload Voters File",
                    inputPlaceholder: "Choose a Voters file",
                    showCancelButton: true,
                    confirmButtonColor: "#F98825",
                    cancelButtonColor: "#d33",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const votersFile = result.value;
                        if (!votersFile) {
                            showNotification(
                                "Voters file is required.",
                                "error"
                            );
                            return;
                        }

                        axios
                            .post(
                                importUrl,
                                {
                                    file: votersFile,
                                },
                                {
                                    headers: {
                                        "X-CSRF-TOKEN": csrfToken,
                                        Accept: "application/json",
                                        "Content-Type": "multipart/form-data",
                                    },
                                }
                            )
                            .then((response) => {
                                return response.data;
                            })
                            .then((data) => {
                                showNotification(data.message, "success");
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            })
                            .catch((error) => {
                                showNotification(
                                    "Failed to import voters data." +
                                        error.message,
                                    "error"
                                );
                            });
                    }
                });
            });
        } else {
            showNotification("SweetAlert2 is not loaded.", "error");
        }
    }
});
