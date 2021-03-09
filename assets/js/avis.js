$("#avis_note_moyenne").html($('#load_more_items').data("average_note")+"/5");


var starRatingControl = new StarRating('.star-rating',{
  initialText: "Choisir une note",
  maxStars: 5
});

$(".review_item").slice(0, 5).show();

$(document).on('click', "#loadMore", function (e) {
  e.preventDefault();
  $(".review_item:hidden").slice(0, 5).slideDown();
  if ($(".review_item:hidden").length == 0) {
    $("#load_more_items").hide();
  }
});

$(document).on('click', "#ajouter_avis", function(e) {
  var note_text = $('.gl-star-rating-text').html();
  var stars = $('.gl-star-rating-stars').find(`[data-text="`+ note_text + `"]`).data('value')

  var formValid = validateForm(stars);

  var email = $("#inputAddress").val();
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  formValid = re.test(email);

  if(formValid) {
    swal({
      title: "Etes-vous sur de vouloir ajouter ce commentaire ?",
      text: "Si oui, finaliser l'action, si non annuler",
      icon: "info",
      buttons: true,
      dangerMode: true,
      confirmButtonClass: "btn-primary",
      buttons: ["Annuler!", true]
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url : "create_comment.php",
            data : {
              nom: $('#inputName').val(),
              email : $('#inputAddress').val(),
              date_location : $('#inputDate').val(),
              note : stars,
              avis : $('#inputMessage').val()
            },
            cache : false,
            success : function(response){
              swal("Action traitée avec succès!", {
                icon: "success",
                timer: 3000
              })
              .then((willDelete) => {
                window.location.href = "avis.php";
              });
            },
            error : function(request, error){
              console.log(error);
            }
          });
        } 
    });
  }
  else
    alert("Merci de saisir une adresse mail valide !")
  });

  function validateForm(stars) {

    var formInvalid = false;
    $(".form input , textarea").each(function() {
      if ($(this).val() === '') {
        formInvalid = true;
      }
    });

    if (stars === undefined || stars === null) 
      formInvalid = true;

    if (formInvalid) {
      alert('Merci de remplir tous les champs');
      return false;
    }
    else
      return true;
  }