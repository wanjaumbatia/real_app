$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    //Make Payment
    $('#collection-form').submit((e) => {
        e.preventDefault();
        const id = $('#id').val();
        const items = $('#collection-form').serializeArray();
        const transactions = [];
        items.forEach(element => {
            transactions.push({
                "id": element.name,
                "amount": element.value
            });
        });
        var data = {
            "transactions": transactions
        }

        fetch("/sep/collection", {
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify(data),
        })
            .then(results => results.json())
            .then((data) => {
                if (data.success == true) {
                    console.log('success');
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    window.location.replace("/sep/customer/" + id);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Payment failed!'
                    })
                }
            })
            .catch(error => console.error(error));
    });

    $('#withdrawal-form').submit((e) => {
        e.preventDefault();
        const amount = $('#amount').val();
        const commission = $('#commission').val();
        
        const id = $('#id').val();

        var data = {
            amount: amount,
            commission: commission
        };

        fetch("/sep/withdrawal_post/" + id, {
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify(data),
        })
            .then(results => results.json())
            .then((data) => {
                if (data.success == true) {
                    if (data.prompt_commission == true) {
                        $('#comm_modal').modal('show');
                    }
                    Toast.fire({
                        icon: 'warning',
                        title: data.message
                    });
                    // window.location.replace("/sep/customer/" + id);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.message
                    })
                }

            })
            .catch(error => console.error(error));
    });
})
