<pre style="display:none;"><?php var_dump($datas); ?></pre>

<div class="card mb-5 mt-5 ml-5 cardArticle">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="<?php echo $datas['article']['media']; ?>" class="card-img w-80" alt="...">
            <button class="btn-com" data-toggle="modal" data-target="#modal-com"><i class="mr-2 fab fa-instagram"></i>Laissez un commentaire</button>
            <?php if (!empty($_SESSION['user'])) { ?>
                <button class="btn-com" data-toggle="modal" data-target="#modif-article"><i class="mr-2 fas fa-pencil-alt"></i>Modifier l'article</button>
                <button class="btn-com" data-toggle="modal" data-target="#modal-delete"><i class="far fa-trash-alt"></i></button>
            <?php } ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card-entete">
                    <h2><img class="photo-profil p-1" style="width: 20%;" src="<?php echo $datas['compte']['photo']; ?>">
                        <?php echo $datas['compte']['pseudo'] ?>
                    </h2>
                </div>
                <h3 class="card-title"><?php echo $datas['article']['titre']; ?></h3>
                <h4 class="card-text"><?php echo $datas['article']['contenu']; ?></h4>

                <div>
                    <strong class="d-block"><?php echo $datas['compte']['pseudo']; ?></strong>
                    <span>TEST COMMENTAIRE A FAIRE</span>
                </div>

                <p>Loloremque quod voluptates temporibus. Ab veniam vel, in libero esse cumque praesentium eligendi reiciendis quae provident. Perspiciatis incidunt pariatur dolorem molestiae facere nam debitis, consectetur modi, aliquid laudantium libero odit voluptates quis? Minima laudantium minus dolore laborum totam iste earum distinctio nesciunt quam consectetur incidunt, cumque rerum? Odio nam et delectus ducimus repellat, nihil magni aspernatur impedit voluptas ullam beatae vitae optio doloremque ad aut omnis esse sapiente nulla molestias incidunt corrupti sunt quae? Quod placeat voluptas natus nostrum ipsa ex magni, dolores, accusamus nesciunt dolorum ipsam reiciendis. Rerum dignissimos nihil, quasi blanditiis nostrum, quibusdam perferendis accusantium officia debitis maiores voluptatibus distinctio! Debitis quos, explicabo suscipit id nam dolores? Ipsa quod laborum, consequatur rem deleniti eligendi cupiditate obcaecati laboriosam eaque velit id, adipisci consequuntur libero ratione accusantium. Praesentium ad maxime modi natus ratione esse a atque exercitationem voluptatem quia harum, molestiae reiciendis alias voluptas nobis iure obcaecati pariatur fugiat eum, repellendus, officiis quod aliquid laborum! Facilis culpa aspernatur quod ipsa velit, ducimus aut. Dolor totam, distinctio eos ratione similique sunt error dolores laudantium culpa dicta, atque iure placeat commodi eum autem, earum explicabo quasi fugit at! Iure sunt voluptatibus maiores, veritatis dolores quae tempore enim porro. Odit, praesentium. Accusamus sint doloribus nesciunt magni sequi veritatis nisi eligendi rem nam minus. Quis quisquam reiciendis dolore voluptatem aperiam distinctio molestias explicabo cumque quia consequatur excepturi autem modi debitis, sunt nobis tempora culpa iste fugit dolores sapiente beatae eligendi rerum sed impedit? Provident nam numquam voluptas dolorem consectetur? Minus omnis ab provident perspiciatis tenetur ut? Rerum facilis placeat quisquam aut nihil debitis, voluptatibus tenetur, deserunt neque sunt ut amet repellendus dolores obcaecati natus rem vitae cupiditate. Dolore nesciunt eos repellendus tempore dolor, suscipit perspiciatis illo eligendi minima non reprehenderit amet nam beatae quod quia distinctio, ipsum placeat! Corporis repudiandae ratione vero nulla quos magni quod quasi exercitationem nemo aperiam sapiente rem saepe repellendus ipsum, nisi voluptatem illo suscipit architecto? Cumque, voluptates quaerat dignissimos molestias ipsa ea, pariatur iste fugiat consectetur non voluptas quos deserunt autem illo aut perferendis, quo distinctio. Perspiciatis explicabo facilis cupiditate accusantium voluptates delectus velit blanditiis incidunt modi facere sapiente quo exercitationem, odit praesentium eum aspernatur laboriosam illum sed et quaerat! Ratione dolorum quidem eos ipsum nostrum sed unde magnam. Voluptate, numquam autem nihil beatae et quam odit illo rem facilis molestias consequatur provident nulla corrupti recusandae quos expedita unde, eligendi earum quae? Maxime, dolorem ab? Totam repellat est, officia, distinctio architecto omnis commodi voluptatibus quam neque rerum, possimus itaque autem accusantium dolorum reprehenderit quo sapiente consequatur.</p>
                <p class="card-text"><small class="text-muted"><?php echo $datas['article']['date_art'] ?></small></p>
            </div>
        </div>
    </div>
</div>




<!-- Modal Commentaire-->
<div class="modal fade" id="modal-com" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Commentaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body modalCom">
                    <textarea name="commentaire" id="commentaire" placeholder="Tapez votre commentaire!"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" nom="submit-com" class="btn-com"><i class="far fa-paper-plane mr-1"></i>Postez!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier un article-->
<div class="modal fade" id="modif-article" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modifiez votre publication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" class="form-control" name="titre" id="titre" value="<?php echo $datas['article']['titre']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Média</label>
                        <input type="text" class="form-control" name="media" id="media" value="<?php echo $datas['article']['media']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Contenu</label>
                        <textarea type="text" class="form-control" name="contenu" id="contenu" placeholder="<?php echo $datas['article']['contenu']; ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date_art" id="date_art" placeholder="date...">
                    </div </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-com"><i class="far fa-paper-plane mr-1"></i>Postez!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal effacer un article-->

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Effacez l'article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-footer">
                    <p>Êtes-vous sûr de vouloir effacer cet article? Cette modification sera irréversible.</p>
                    <button type="submit" name="submit" class="btn-com"><i class="mr-2 fas fa-skull-crossbones"></i>Oui, je suis sûr</button>
                </div>
            </form>
        </div>
    </div>
</div>