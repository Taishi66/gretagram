<main class="content">
    <div class="container p-0">
        <? DebugFacade::dump($datas) ?>

        <div class="card mt-5">
            <div class="row g-0">
                <div class="col-12 col-lg-12 col-xl-12 CONVO">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1">
                            <?php if ($datas['inbox'][0]['pseudo'] === CompteFacade::getComptePseudo()) { ?>
                                <div class="position-relative">
                                    <img src="/<?= $datas['inbox'][1]['photo']; ?>" class="rounded-circle mr-1" alt="<?= $datas['inbox'][1]['pseudo']; ?>" width="40" height="40">
                                </div>
                                <!-- Destinataire discussion -->
                                <div class="flex-grow-1 pl-3">
                                    <strong><?= $datas['inbox'][1]['pseudo']; ?></strong>
                                </div>
                                <div>
                                    <button class="btn btn-light btn-lg mr-1 px-3"><a style="text-decoration:none;color:black;" href="/Compte/<?= $datas['inbox'][1]['id_compte'] ?>">Voir son profil</a></button>
                                    <button class="btn btn-light border btn-lg px-3"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            <?php } else { ?>
                                <div class="position-relative">
                                    <img src="/<?= $datas['inbox'][0]['photo']; ?>" class="rounded-circle mr-1" alt="<?= $datas['inbox'][0]['pseudo']; ?>" width="40" height="40">
                                </div>
                                <!-- Destinataire discussion -->
                                <div class="flex-grow-1 pl-3">
                                    <strong><?= $datas['inbox'][0]['pseudo']; ?></strong>
                                </div>
                                <div>
                                    <button class="btn btn-light btn-lg mr-1 px-3"><a style="text-decoration:none;color:black;" href="/Compte/<?= $datas['inbox'][0]['id_compte'] ?>">Voir son profil</a></button>
                                    <button class="btn btn-light border btn-lg px-3"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            <!-- discussion message -->
                            <?php foreach ($datas['inbox'] as $inbox) {
                                if (CompteFacade::getCompteId() !== $inbox['outgoing_msg_id']) { ?>
                                    <div class="chat-message-right pb-4 msg_id" data-msg_id="<?= ($inbox['outgoing_msg_id'] == CompteFacade::getCompteId()) ? $inbox['outgoing_msg_id'] : CompteFacade::getCompteId() ?>">
                                        <div>
                                            <img src="/<?= $inbox['photo']; ?>" class="rounded-circle mr-1 border border-solid" width="40" height="40">
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1"><?= $inbox['pseudo']; ?></div>
                                            <?= $inbox['msg']; ?>
                                            <!-- Heure d'envoie du message -->
                                            <div class="text-muted small text-nowrap mt-2"><?= $inbox['date_message']; ?></div>
                                        </div>
                                    </div><?php } else { ?>
                                    <div class="chat-message-left pb-4 msg_id" data-msg_id="<?= ($inbox['outgoing_msg_id'] == CompteFacade::getCompteId()) ? $inbox['outgoing_msg_id'] : CompteFacade::getCompteId() ?>">
                                        <div>
                                            <img src="/<?= CompteFacade::getComptePhoto(); ?>" class="rounded-circle mr-1" width="40" height="40">
                                        </div>
                                        <div class="flex-shrink-1 bg-white rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1"><?= CompteFacade::getComptePseudo(); ?></div>
                                            <?= $inbox['msg']; ?>
                                            <!-- Heure d'envoie du message -->
                                            <div class="text-muted small text-nowrap mt-2"><?= $inbox['date_message']; ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <!-- formulaire d'envoie message -->
                        <div class="flex-grow-0 py-3 px-4 border-top chat-box">
                            <div class="input-group ">
                                <input type="text" class="hidden" name="outgoing_id" value="<?= CompteFacade::getCompteId(); ?>">
                                <input type="text" class="hidden" name="incoming_id" value="<?= ($datas['inbox'][0]['id_compte'] === CompteFacade::getCompteId()) ? $datas['inbox'][1]['id_compte'] : $datas['inbox'][0]['id_compte'] ?>">
                                <input type="text" class="rounded form-control input-field" name="contenu_message" placeholder="Type your message">
                                <button type="submit" class="btn btn-light btn-post-message w-100 mt-2" name="message">Send</button>
                                </input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>