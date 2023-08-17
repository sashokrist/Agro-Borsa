$(document).ready(function () {
    $(".closeModal").click(function (e) {
        e.preventDefault();
        $("#createOfferForm")[0].reset(); // Reset the form
        // Close the modal
        $("#createOfferModal").modal('hide');
    });

    // Pass items data to modal when it's shown
    $('#createOfferModal').on('show.bs.modal', function (event) {
        // ... Existing code ...

        // Enable draggable and resizable
        modal.find('.draggable').draggable();
        modal.find('.resizable').resizable();
    });

    // Handle form submission
    $('#createOfferForm').submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                // Show success message on the index page notification bar
                $('#notificationBar').text('Offer created successfully').removeClass('d-none');

                // Close the modal
                $('#createOfferModal').modal('hide');
            },
            error: function (error) {
                // Handle error
            }
        });
    });

    // Show Offer Modal
    $('.btn-show').click(function () {
        var offerId = $(this).data('offer-id');
        var product = $(this).data('item-id');
        var name = $(this).data('offer-name');
        var description = $(this).data('offer-description');
        var amount = $(this).data('offer-amount');
        var quantity = $(this).data('offer-quantity');
        var price = $(this).data('offer-price');
        var location = $(this).data('offer-location');

        console.log(offerId);


        // Populate modal with offer details
        $('#item-id').text(product);
        $('#name').text(name);
        $('#description').text(description);
        $(e.currentTarget).find('input[name="user_id"]').val(offerId);
        // Show the modal
        $('#showOfferModal').modal('show');
    });

    // Handle modal hidden event
    $('#showOfferModal').on('hidden.bs.modal', function () {
        // Reset the offer details when the modal is closed
        $('#name').text('');
        $('#description').text('');
    });
});
