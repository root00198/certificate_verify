<div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="pro-user-name ml-1">
                                <?php 
                                session_start();
                                // if(isset($_SESSION["access"])==false)
                                // {
                                //     $newURL = "https://whataftercollege.com/certificate_verify/backend/login.html";
                                //     header('Location: '.$newURL);
                                //     die();
                                // }
                                ?>
                                Certificate Verifier
                            </span>
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-left mb-0">
                    <li class="float-left">
                        <a href="index.html" class="logo">
                            <span class="logo-lg">
                                <img src="assets/images/logo-light.png" alt="" height="22">
                            </span>
                            <span class="logo-sm">
                                <img src="assets/images/logo-light.png" alt="" height="24">
                            </span>
                        </a>
                    </li>
                </ul>
            </div>