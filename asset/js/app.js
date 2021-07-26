//une fois la page chargé
$(document).ready(function() {
    //crée un évènement onclick sur le button class open-commentaire et on execute la fonction
    $(document).on('click', 'button.open-commentaire', function() {
        var element = $(this);

        //correspond à data-article="$this->data-article", attribut div commentaire
        var article = element.data('article');
        //on retire la classe hidden
        $('.commentaire[data-article="' + article + '"]').removeClass('hidden');
        element.remove()
    })

    //Nouvel évènement onclick sur le button avec la classe toggle-like
    $(document).on('click', 'button.toggle-like', function() {
        var element = $(this);
        var article = element.data('article'); //this.data-article
        var text = element.data('text'); //this.data-text

        // Je fais une requête post sur l'url /article
        $.post("/article", {
                like: "true", //On force une valeur au paramètre like pour entrer dans les conditions !empty ou isset
                id_article: article,
            },
            function(data, status) {

                if (status == 'success') { //si le post est envoyé, on parse les données JSON crées par le controller
                    var datas = JSON.parse(data);
                    /*$output = [
                                    'nb_likes' => $this->likeModel->getNbLikeForArticle($id_article),
                                    'is_liked' => $is_liked,
                                ];
                                echo json_encode($output); //retourne la représentation JSON d'une valeur
                                exit;*/
                    var nb_likes = datas.nb_likes;
                    var is_liked = datas.is_liked;
                    //Si "like" n'est pas écrit dans la présentation alors il renverra le data-text vide comme dans article.php
                    var like = (nb_likes > 1 && text != '') ? text + 's' : text;
                    $('.nb_likes[data-article="' + article + '"]').empty().append(nb_likes + ' ' + like);
                    if (is_liked == true) {
                        $('.toggle-like[data-article="' + article + '"] i').removeClass('far').addClass('fas')
                    } else { //Détermine si le coeur du like sera plein ou vide en fonction de s'il est déjà liké par l'user
                        $('.toggle-like[data-article="' + article + '"] i').removeClass('fas').addClass('far')
                    }
                } else {
                    console.log('error')
                }
            });
    })


    //Partie commentaire
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
                    console.log(data);
                    /*$output = [
                                    'pseudo' => CompteFacade::getComptePseudo(),
                                    'message' => 'commentaire posté!',
                                    'nb_comments' => $this->commentaireModel->getNbcomFromArticle($id_article),
                                    'commentaire' => $this->commentaireModel->getLastComFromArticle($id_article)
                                ];
            echo json_encode($output); //retourne la représentation JSON d'une valeur
            exit;
                    */
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
                        }, 3000) // 3sc temps de la notif

                } else {
                    console.log('error');
                }
            }
        );

    });

    //partie conversations
    $(".btn-post-message").click(function() {
        var parentElement = $(this).parent();

        var message = parentElement.find("input[name=contenu_message]").val();
        var incoming_id = parentElement.find("input[name=incoming_id]").val();
        var outgoing_id = parentElement.find("input[name=outgoing_id]").val();

        $.post("/Inbox/" + incoming_id, {
                message: message,
                incoming_id: incoming_id,
                outgoing_id: outgoing_id
            },
            function(data, status) {
                if (status == 'success') {
                    console.log(data);

                    var datas = JSON.parse(data);

                    var message_template = '<div class="chat-message-left pb-4">' +
                        '<div>' +
                        '<img src="/' + datas.photo + '" class="rounded-circle mr-1" width="40" height="40">' +
                        '</div>' +
                        '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">' +
                        '<div class="font-weight-bold mb-1">' + datas.pseudo + '</div>' +
                        message +
                        '<div class="text-muted small text-nowrap mt-2" data-msg_id=' + datas.msg_id + '>'
                    datas.date_message + '</div>' +
                        '</div>' +
                        '</div>';
                }
                $('.chat-messages').append(message_template);

            });
    });
    window.setInterval(refreshChat(), 1000);
    //récupérer l'id du dernier message a partir du PHP, (sql), ce sera le paramètre
    //de la méthode refreshChat()
    //
    function refreshChat() {
        var parentElement = $(this).parent();
        var incoming_id = parentElement.data('incoming_id');
        var msg_id = parentElement.data('msg_id');
        $.get("/Inbox/" + incoming_id, {
                msg_id: msg_id
            },
            function(data, status) {
                if (status == 'success') {

                    datas = JSON.parse(data);

                    while (datas.length > 0) {
                        var message_template = '<div class="chat-message-left pb-4">' +
                            '<div>' +
                            '<img src="/' + datas.photo + '" class="rounded-circle mr-1" width="40" height="40">' +
                            '</div>' +
                            '<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">' +
                            '<div class="font-weight-bold mb-1">' + datas.pseudo + '</div>' +
                            message +
                            '<div class="text-muted small text-nowrap mt-2" data-msg_id=' + msg_id + '>'
                        datas.date_message + '</div>' +
                            '</div>' +
                            '</div>';

                        if (outgoing_id == outgoing_id) {
                            $('chat-message').append(message_template);
                        } else {
                            $('chat-message').append(message_template);
                        }
                    }
                }
            });
    }
});