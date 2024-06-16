const datatableCall = (targetId, url, columns) => {
    $(`#${targetId}`).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: "GET",
            data: function (d) {
                d.mode = "datatable";
                d.bulan = $("#bulan_filter").val() ?? null;
                d.tahun = $("#tahun_filter").val() ?? null;
                d.tanggal = $("#tanggal_filter").val() ?? null;
                d.kategori = $("#kategori_filter").val() ?? null;
            },
        },
        columns: columns,
        lengthMenu: [
            [50, 100, 250, -1],
            [50, 100, 250, "All"],
        ],
    });
};

const ajaxCall = (url, method, data, successCallback, errorCallback) => {
    $.ajax({
        type: method,
        enctype: "multipart/form-data",
        url,
        cache: false,
        data,
        contentType: false,
        processData: false,
        headers: {
            Accept: "application/json",
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        },
        dataType: "json",
        success: function (response) {
            successCallback(response);
        },
        error: function (error) {
            errorCallback(error);
        },
    });
};

const setButtonLoadingState = (buttonSelector, isLoading, title = "Simpan") => {
    const buttonText = isLoading
        ? `<div class="spinner-border spinner-border-sm me-2" role="status">
            </div>
         ${title}`
        : title;
    $(buttonSelector).prop("disabled", isLoading).html(buttonText);
};

const notification = (type, message) => {
    Swal.fire({
        type,
        title: type === "success" ? "Success" : "Error",
        text: message,
        showConfirmButton: true,
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true,
    });
};

const getModal = (targetId, url = null, fields = null) => {
    $(`#${targetId}`).modal("show");
    $(`#${targetId} .form-control`).removeClass("is-invalid");
    $(`#${targetId} .invalid-feedback`).html("");

    const cekLabelModal = $("#label-modal");
    if (cekLabelModal) {
        $("#id").val("");
        cekLabelModal.text("Tambah");
    }

    if (url) {
        cekLabelModal.text("Edit");

        const successCallback = function (response) {
            fields.forEach((field) => {
                if (response.data[field]) {
                    $(`#${targetId} #${field}`)
                        .val(response.data[field])
                        .trigger("change");
                }
            });
        };

        const errorCallback = function (error) {
            console.log(error);
        };

        ajaxCall(url, "GET", null, successCallback, errorCallback);
    }
    $(`#${targetId} .form-control`).val("");
};

const handleValidationErrors = (error, formId = null, fields = null) => {
    if (error.response && error.response.data && fields) {
        fields.forEach((field) => {
            const fieldElement = $(`#${formId} #${field}`);
            const errorElement = $(`#${formId} #error${field}`);

            if (error.response.data[field]) {
                fieldElement.addClass("is-invalid");
                errorElement.html(error.response.data[field][0]);
            } else {
                fieldElement.removeClass("is-invalid");
                errorElement.html("");
            }
        });
    } else if (error.responseJSON && error.responseJSON.message) {
        notification("error", error.responseJSON.message);
    } else if (error.message) {
        notification("error", error.message);
    } else {
        notification("error", "An unexpected error occurred.");
    }
};


const handleSuccess = (
    response,
    dataTableId = null,
    modalId = null,
    redirect = null
) => {
    if (dataTableId !== null) {
        notification("success", response.message);
        $(`#${dataTableId}`).DataTable().ajax.reload();
    }

    if (modalId !== null) {
        $(`#${modalId}`).modal("hide");
    }

    if (redirect !== null) {
        if (redirect === "no") {
            notification("success", response.message ?? response);
        } else {
            notification("success", response.message ?? response);
            setTimeout(() => {
                window.location.href = redirect;
            }, 1500);
        }
    }
};

const confirmDelete = (url, tableId) => {
    Swal.fire({
        title: "Apakah Kamu Yakin?",
        text: "Ingin menghapus data ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            const data = null;

            const successCallback = function (response) {
                handleSuccess(response, tableId, null);
            };

            const errorCallback = function (error) {
                console.log(error);
            };

            ajaxCall(url, "DELETE", data, successCallback, errorCallback);
        }
    });
};

