<main class="content">
    <div class="container p-0">
        <? DebugFacade::dump($datas) ?>
        <center>
            <h1 class="h3 mb-3 mt-2">Conversations</h1>
        </center>

        <div class="card">

            <!-- formulaire de recherche user avec qui une discussion est ouverte -->
            <div class="px-4 d-none d-md-block">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <form method="POST">
                            <input type="hidden" name="page" value="recherche">
                            <input class="form-control my-3" type="search" name="query" id="query" placeholder="Search conversation">
                            <button type="submit" style="display:none;" name="submit"></button>
                        </form>
                    </div>
                </div>
            </div>
            <?php foreach ($datas['inbox'] as $inbox) { ?>
                <a href="/Inbox/<?= $inbox['id_compte'] ?>" class="list-group-item list-group-item-action border-0">
                    <!-- Nombre de message non lu -->
                    <div class="badge bg-success float-right">5</div>
                    <div class="d-flex align-items-start">
                        <img src="<?= $inbox['photo']; ?>" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                        <div class="flex-grow-1 ml-3">
                            <?= $inbox['pseudo']; ?>
                            <!-- destinataire est il connecté? -->
                            <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                        </div>
                    </div>
                </a>
                <hr class="d-block d-lg-none mt-1 mb-0">
            <?php  } ?>
        </div>
    </div>
</main>