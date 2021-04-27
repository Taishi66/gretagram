$(document).ready(function() {
    $(document).on('click', 'button.open-commentaire', function() {
        var element = $(this);
        var article = element.data('article');

        $('.commentaire[data-article="' + article + '"]').removeClass('hidden');
        element.remove()
    })

    $(document).on('click', 'button.toggle-like', function() {
        var element = $(this);
        var article = element.data('article');

        $.post("/article", {
                like: "OK",
                id_article: article,
            },
            function(data, status) {
                if (status == 'success') {
                    var datas = JSON.parse(data);
                    var nb_likes = datas.nb_likes;
                    var is_liked = datas.is_liked;

                    var like = (nb_likes > 1) ? 'Likes' : 'Like';
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

    $("#commentButton").click(function() {
        var com = $(this).find("input[name=comment]").val();
        $.post("/article", {
                com: com,
            },
            function(data) {
                if (data == 'success') {
                    $("#postCom").html(com);
                }
            }
        );

    });
});