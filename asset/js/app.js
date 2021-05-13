$(document).ready(function() {
    //une fois la page chargé
    $(document).on('click', 'button.open-commentaire', function() {
        //crée un onclick sur le button class open-commentaire et on execute la fonction
        var element = $(this);
        var article = element.data('article');
        //correspond à $this->data-article, attribut div commentaire

        $('.commentaire[data-article="' + article + '"]').removeClass('hidden');
        //on retire 
        element.remove()
    })

    $(document).on('click', 'button.toggle-like', function() {
        var element = $(this);
        var article = element.data('article');
        var text = element.data('text');

        $.post("/article", {
                like: "OK",
                id_article: article,
            },
            function(data, status) {

                if (status == 'success') {
                    var datas = JSON.parse(data);
                    var nb_likes = datas.nb_likes;
                    var is_liked = datas.is_liked;

                    var like = (nb_likes > 1 && text != '') ? text + 's' : text;
                    $('.nb_likes[data-article="' + article + '"]').empty().append(nb_likes + ' ' + like);
                    if (is_liked == true) {
                        $('.toggle-like[data-article="' + article + '"] i').removeClass('far').addClass('fas')
                    } else {
                        $('.toggle-like[data-article="' + article + '"] i').removeClass('fas').addClass('far')
                    }

                } else {
                    console.log('error')
                }
            });

    })



    $(".btn-post-comment").click(function() {
        var parentElement = $(this).parent();

        var com = parentElement.find("input[name=comment]").val();
        var article = parentElement.data('article');
        var media_page = parentElement.data('mediapage');
        var myaccount = parentElement.data('myaccount');

        $.post("/article", {
                commentaire: com,
                id_article: article,
            },
            function(data, status) {
                if (status == 'success') {
                    var datas = JSON.parse(data);
                    // datas.nb_comments
                    var notif = '<div class="alert alert-success notif-temporaire">' + datas.message + '</div>';
                    if (media_page == "media") {
                        parentElement.find("input[name=comment]").val('');
                        $('.modal .close').trigger('click');

                        var myaccount_template = '';
                        if (myaccount == true) {
                            myaccount_template = '<a href="/delete_com&id_com=' + datas.commentaire.id_com + '">' +
                                '<span class="com-sup"><i class="far fa-trash-alt"></i></span>' +
                                '</a>';
                        }

                        var comment_template = '<div class="mb-2 card-header cardCom commentaire">' +
                            '<strong class="d-block">' + datas.pseudo +
                            myaccount_template +
                            '</strong>' +
                            '<span>' + com + '</span>' +
                            '<p class="text-muted" style="font-size: small;">' + datas.commentaire.date_com + '</p>' +
                            '</div>';

                    } else {
                        var comment_template = '<div class="commentaire" data-article="' + article + '">' +
                            '<div>' +
                            '   <strong id="comPseudo" class="d-block">' + datas.pseudo + '</strong>' +
                            '   <span id="comPost">' + com + '</span>' +
                            '</div>' +
                            '</div>';
                        //parentElement.after(notif);
                        parentElement.find("input[name=comment]").val('');


                    }

                    $('.comment-list[data-article="' + article + '"]').find('.no-comment').remove();
                    $('.comment-list[data-article="' + article + '"]').prepend(comment_template);

                    $('.notif-temporaire').remove();
                    $('body').append(notif)
                    $('.notif-temporaire').addClass('open');

                    window.setTimeout(function() {
                        $('.notif-temporaire').removeClass('open');
                    }, 3000)

                } else {
                    console.log('error');
                }
            }
        );

    });
});