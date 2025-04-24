(function ($) {
    $(function () {

        const viewOpModal = document.getElementById('modal-view');

        if (viewOpModal) {
            viewOpModal.addEventListener('show.bs.modal', event => {
                
                const button = event.relatedTarget
                const optitle = button.getAttribute('data-bs-optitle')

                //Update the modal's content
                const modalTitle = viewOpModal.querySelector('#op-num')
                modalTitle.textContent = `#${optitle}`

                const modalBody = viewOpModal.querySelector('#op-body')
                modalBody.innerHTML = '<div class="d-flex align-items-center" style="min-height:450px;"><div class="flex-grow-1 text-center"><i class="mdi mdi-loading mdi-spin mdi-36px"></i></div></div>'

                $.ajax({
                    "url": "/user/operation-view",
                    "method": "post",
                    "data": {"docnum": optitle}

                }).done(function (data) {
                    const modalBody = viewOpModal.querySelector('.modal-body')
                    modalBody.innerHTML = data
                })
            })
        }

        // Create operation popup
        const createOpModal = document.getElementById('modal-create');

        if (createOpModal) {
            createOpModal.addEventListener('show.bs.modal', event => {
                
                // const button = event.relatedTarget;
                // const invId = button.getAttribute('data-inv-id')
                const modalBody = createOpModal.querySelector('.modal-body-pjax')

                modalBody.innerHTML = '<p class="text-center fs-1 my-4"><i class="bx bx-loader bx-spin"></i></p>'

                $.ajax({
                    "method": "get",
                    "url": "/user/operation-create",
                    "data": {"task": 'cashin'}
                }).done(function (data) {
                    modalBody.innerHTML = data
                });

            })
        }

        // Multi actions
        $(document).on('click', '#multi-actions > button', function (e) {
            var status = this.getAttribute('data-status');
            var keys = $('#w0').yiiGridView('getSelectedRows');
            if (keys.length) {
                $.ajax({
                    "method": "post",
                    "url": "/user/operation-multi-update",
                    "data": {"status": status, "keys": keys}
                }).done(function (data) {
                    location.reload();
                });
            } else {
                alert( 'Not selected!' );
            }
        })

    })
})(jQuery);