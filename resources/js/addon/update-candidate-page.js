document.addEventListener("DOMContentLoaded", function () {
    // handle submit form
    const form = document.getElementById("update-candidate-form");
    if (form) {
        // submit form using axios
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const action = form.dataset.action || form.getAttribute("action");
            const method = form.dataset.method || form.getAttribute("method") || "PUT";
            const redirectUrl = form.dataset.redirect || form.getAttribute("data-redirect") || null;

            const formData = new FormData(form);

            // if input files are empty, remove them from formData to avoid overwriting existing files with null
            const fileInputs = form.querySelectorAll('input[type="file"]');
            fileInputs.forEach((input) => {
                if (input.files.length === 0) {
                    formData.delete(input.name);
                }
            });

            axios({
                method: method,
                url: action,
                data: formData,
                headers: {
                    "Content-Type": "multipart/form-data",
                    "Accept": "application/json",
                },
            })
                .then((response) => {
                    if (typeof window.Toast !== "undefined") {
                        window.Toast.fire({
                            icon: 'success',
                            title: 'Candidate updated successfully!'
                        });
                    } else {
                        alert("Candidate updated successfully!");
                    }
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                })
                .catch((error) => {
                    let message = "An error occurred while submitting the form.";
                    if (error.response && error.response.data && error.response.data.message) {
                        message = error.response.data.message;
                    }
                    if (typeof window.Toast !== "undefined") {
                        window.Toast.fire({
                            icon: 'error',
                            title: message
                        });
                    } else {
                        alert(message);
                    }
                });
        });
    }

    // Handle missions and programs dynamic input fields (refactored & DRY)
    const escapeHTML = (s = "") =>
        String(s).replace(
            /[&<>"']/g,
            (c) =>
                ({
                    "&": "&amp;",
                    "<": "&lt;",
                    ">": "&gt;",
                    '"': "&quot;",
                    "'": "&#39;",
                }[c])
        );

    /**
     * Multi-value input manager factory
     * config:
     *  - name: form input base name (e.g. "missions" => inputs named "missions[]")
     *  - max: max items
     *  - previewId: id of element where items are shown
     *  - containerId: id that may contain the source input
     *  - addBtnId: id of add button
     *  - inputSelectors: array of selectors (searched inside container first, then document)
     */
    function createListManager({
        name,
        max,
        previewId,
        containerId,
        addBtnId,
        inputSelectors = [],
    }) {
        const preview = document.getElementById(previewId);
        const container = document.getElementById(containerId);
        const addBtn = document.getElementById(addBtnId);

        // find input: search inside container by provided selectors, then fallback to first text input in container,
        // then try document-wide selectors
        let field = null;
        if (container) {
            for (const sel of inputSelectors) {
                const el = container.querySelector(sel);
                if (el) {
                    field = el;
                    break;
                }
            }
            if (!field)
                field = container.querySelector(
                    'input[type="text"], input[type="search"], input[type="search"]'
                );
        }
        if (!field) {
            for (const sel of inputSelectors) {
                const el = document.querySelector(sel);
                if (el) {
                    field = el;
                    break;
                }
            }
        }

        if (!preview) return null;

        const itemClass = `${name}-item`;
        const deleteBtnClass = `delete-${name}-btn`;

        const refresh = () => {
            const count = preview.querySelectorAll(`.${itemClass}`).length;
            if (addBtn) {
                const disabled = count >= max;
                addBtn.disabled = disabled;
                addBtn.classList.toggle("opacity-50", disabled);
                addBtn.classList.toggle("cursor-not-allowed", disabled);
            }
        };

        const createItemNode = (value) => {
            const escaped = escapeHTML(value);
            const div = document.createElement("div");
            div.className = `${itemClass} mb-2`;
            div.innerHTML = `
                    <div class="flex items-center w-full">
                        <span class="w-9/10 px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-100 break-words" title="${escaped}">
                            ${escaped}
                        </span>
                        <input type="hidden" name="${name}[]" value="${escaped}">
                        <button type="button" class="${deleteBtnClass} ml-3 w-1/10 bg-primary-600 hover:bg-primary-700 text-white p-2 rounded-lg cursor-pointer shadow-md flex items-center justify-center">
                            <box-icon name="trash" color="#ff0000ff"></box-icon>
                        </button>
                    </div>
                `;
            return div;
        };

        // delegated delete handler
        preview.addEventListener("click", (ev) => {
            const btn =
                ev.target.closest && ev.target.closest(`.${deleteBtnClass}`);
            if (!btn) return;
            const item = btn.closest(`.${itemClass}`);
            if (item) {
                item.remove();
                refresh();
            }
        });

        // add handler
        if (addBtn) {
            addBtn.addEventListener("click", (e) => {
                e.preventDefault();
                const value = field ? field.value.trim() : "";
                if (!value) {
                    if (field) {
                        field.classList.add("border-red-500");
                        field.focus();
                        setTimeout(
                            () => field.classList.remove("border-red-500"),
                            800
                        );
                    }
                    return;
                }
                const currentCount = preview.querySelectorAll(
                    `.${itemClass}`
                ).length;
                if (currentCount >= max) return;
                const node = createItemNode(value);
                preview.appendChild(node);
                if (field) {
                    field.value = "";
                    field.focus();
                }
                refresh();
            });
        }

        // optionally allow Enter to add (when focus in field)
        if (field) {
            field.addEventListener("keydown", (e) => {
                if (e.key === "Enter") {
                    e.preventDefault();
                    if (addBtn) addBtn.click();
                }
            });
        }

        // hydrate existing inputs: prefer already-rendered items; otherwise build from server inputs named NAME[]
        (function hydrate() {
            if (preview.querySelectorAll(`.${itemClass}`).length > 0) {
                refresh();
                return;
            }
            const existing = document.querySelectorAll(
                `input[name="${name}[]"]`
            );
            for (const inp of existing) {
                if (!inp.value || !inp.value.trim()) continue;
                if (preview.querySelectorAll(`.${itemClass}`).length >= max)
                    break;
                const node = createItemNode(inp.value.trim());
                preview.appendChild(node);
                // remove original to avoid duplicate values on submit
                inp.remove();
            }
            refresh();
        })();

        // public API (if needed)
        return { refresh };
    }

    // instantiate for missions and programs
    createListManager({
        name: "missions",
        max: 3,
        previewId: "missions-preview",
        containerId: "missions-input-container",
        addBtnId: "add-mission-btn",
        inputSelectors: [
            'input[data-role="mission-input"]',
            'input[name="mission"]',
            "#mission",
            "#mission-input",
        ],
    });

    createListManager({
        name: "programs",
        max: 5,
        previewId: "programs-preview",
        containerId: "programs-input-container",
        addBtnId: "add-program-btn",
        inputSelectors: [
            'input[data-role="program-input"]',
            'input[name="program"]',
            "#program",
            "#program-input",
        ],
    });

    // display file preview in form
    const photoInput = document.getElementById("photo");
    const photoPreviewContainer = document.getElementById(
        "photo-preview-container"
    );
    const photoPreview = document.getElementById("photo-preview");

    if (photoInput) {
        photoInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    photoPreview.src = e.target.result;
                    photoPreviewContainer.classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            } else {
                photoPreview.src = "#";
                photoPreviewContainer.classList.add("hidden");
            }
        });
    }

    const setupFilePreview = (inputId, containerId) => {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        if (!input || !container) return;

        const revokeUrl = () => {
            if (container.dataset.url) {
                try {
                    URL.revokeObjectURL(container.dataset.url);
                } catch (e) {
                    /* ignore */
                }
                delete container.dataset.url;
            }
        };

        const renderHtml = (file, url) => {
            const sizeKB = (file.size / 1024).toFixed(1);
            const fileType =
                file.type ||
                (file.name && file.name.split(".").pop()) ||
                "file";
            // keep markup concise and identical to original styling
            return `
                    <div class="flex items-center justify-between p-3 border rounded-md bg-gray-50">
                        <div class="flex items-center space-x-3 min-w-0">
                            <div class="min-w-0">
                                <a href="${url}" target="_blank" rel="noopener noreferrer" class="block text-sm font-medium text-blue-600 underline truncate" title="${file.name}">
                                    ${file.name}
                                </a>
                                <div class="text-xs text-gray-500">
                                    ${sizeKB} KB • ${fileType}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="${url}" download class="text-sm px-2 py-1 rounded text-gray-700 hover:bg-gray-50">
                                <box-icon name="cloud-download" type="solid"></box-icon>
                            </a>
                            <button type="button" class="remove-file-btn text-sm px-2 py-1 text-red-600 hover:bg-red-50 rounded cursor-pointer">
                                <box-icon name="trash" type="solid"></box-icon>
                            </button>
                        </div>
                    </div>
                `;
        };

        input.addEventListener("change", function () {
            const file = this.files && this.files[0];
            if (!file) {
                // clear UI and any previous object URL
                revokeUrl();
                container.innerHTML = "";
                container.classList.add("hidden");
                input.value = "";
                return;
            }

            // revoke previous URL if any, then create new
            revokeUrl();
            const fileUrl = URL.createObjectURL(file);
            container.dataset.url = fileUrl;
            container.innerHTML = renderHtml(file, fileUrl);
            container.classList.remove("hidden");

            const removeBtn = container.querySelector(".remove-file-btn");
            if (removeBtn) {
                removeBtn.addEventListener(
                    "click",
                    function () {
                        // clear input and UI, revoke url
                        input.value = "";
                        revokeUrl();
                        container.innerHTML = "";
                        container.classList.add("hidden");
                    },
                    { once: true }
                );
            }
        });
    };

    setupFilePreview("resume", "resume-preview-container");
    setupFilePreview("attachment", "attachment-preview-container");
});
