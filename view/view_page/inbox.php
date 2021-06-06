<main class="content">
    <div class="container p-0">

        <h1 class="h3 mb-3 mt-2">Discussions</h1>

        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right">
                    <!-- formulaire de recherche user avec qui une discussion est ouverte -->
                    <div class="px-4 d-none d-md-block">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control my-3" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="list-group-item list-group-item-action border-0">
                        <!-- Nombre de message non lu -->
                        <div class="badge bg-success float-right">5</div>
                        <div class="d-flex align-items-start">
                            <img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                            <div class="flex-grow-1 ml-3">
                                Vanessa Tucker
                                <!-- destinataire est il connecté? -->
                                <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                            </div>
                        </div>
                    </a>
                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1">
                            <div class="position-relative">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                            </div>
                            <!-- Destinataire discussion -->
                            <div class="flex-grow-1 pl-3">
                                <strong>Sharon Lessman</strong>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-lg mr-1 px-3"><a style="text-decoration:none;color:white;" href="/Compte/<?= $suggestion['id_compte'] ?>">Voir son profil</a></button>
                                <button class="btn btn-light border btn-lg px-3"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            <!-- discussion message -->
                            <div class="chat-message-right pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                    <!-- Heure d'envoie du message -->
                                    <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">You</div>
                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                </div>
                            </div>

                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    <!-- Heure d'envoie du message -->
                                    <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                </div>
                            </div>
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