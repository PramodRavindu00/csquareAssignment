
document.addEventListener('DOMContentLoaded', function() {
    var deleteLinks = document.querySelectorAll('.deleteLink');    //select element

    deleteLinks.forEach(function(deleteLink) {
        deleteLink.addEventListener('click', function(event) {     //click event listener
            event.preventDefault();   //preventing the default behaviour of the link

            var href = this.getAttribute('href');   //get the value of the href

            swal({
                title: "Are you sure you want to delete?",
                text: "Deleted data can never be recovered",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then(function(isOkay) {
                if (isOkay) {   //redirecting if the Ok button clicked
                    window.location.href = href;
                } else {
                    
                }
            });
        });
    });
});