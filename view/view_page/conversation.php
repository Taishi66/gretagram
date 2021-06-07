<main class="content">
    <div class="container p-0">
        <?= DebugFacade::dump($datas) ?>
        <center>
            <h1 class="h3 mb-3 mt-2">Conversation</h1>
        </center>

        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-12 col-xl-12 CONVO">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1">
                            <div class="position-relative">
                                <img src="/<?= $datas['inbox'][0]['photo']; ?>" class="rounded-circle mr-1" alt="<?= $datas['inbox'][0]['pseudo']; ?>" width="40" height="40">
                            </div>
                            <!-- Destinataire discussion -->
                            <div class="flex-grow-1 pl-3">
                                <strong><?= $datas['inbox'][0]['pseudo']; ?></strong>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-lg mr-1 px-3"><a style="text-decoration:none;color:white;" href="/Compte/<?= $datas['inbox'][0]['id_compte'] ?>">Voir son profil</a></button>
                                <button class="btn btn-light border btn-lg px-3"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            <!-- discussion message -->
                            <?php foreach ($datas['inbox'] as $inbox) {
                                if (CompteFacade::getCompteId() == $inbox['id_compte']) { ?>
                                    <div class="chat-message-right pb-4">
                                        <div>
                                            <img src="/<?= $datas['compte']['photo']; ?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <!-- Heure d'envoie du message -->
                                            <div class="text-muted small text-nowrap mt-2"><?= $inbox['date_message']; ?></div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1"><?= CompteFacade::getComptePseudo(); ?></div>
                                            <?= $inbox['contenu_message']; ?>
                                        </div>
                                    </div><?php } else { ?>
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="/<?= $datas['compte']['photo']; ?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <!-- Heure d'envoie du message -->
                                            <div class="text-muted small text-nowrap mt-2"><?= $inbox['date_message']; ?></div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1"><?= $inbox['pseudo']; ?></div>
                                            <?= $inbox['contenu_message']; ?>
                                        </div>
                                    <?php } ?>
                                    </div>
                                <?php } ?>
                                <!-- formulaire d'envoie message -->
                                <div class="flex-grow-0 py-3 px-4 border-top">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="contenu_message" placeholder="Type your message">
                                        <button class="btn btn-primary" name="message">Send</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>