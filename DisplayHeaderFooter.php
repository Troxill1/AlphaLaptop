<?php
    function displayHeader() { ?>
        <ul>
            <li><a href="./" id="logo"><img src="./images/logo.png" alt="Logo"></a></li>
            <li><a href="./">Начало</a></li>
            <li>
                <a>Категории&nbsp;<i class="fas fa-caret-down"></i></a>
                <div class="dropdown">
                    <ul>
                        <li>
                            <a>Лаптопи&nbsp;<i class="fas fa-caret-right"></i></a>
                            <div class="subdropdown">
                                <ul>
                                    <li><a href="Products.php?category=Gaming">Гейминг</a></li>
                                    <li><a href="Products.php?category=Business">Бизнес</a></li>
                                    <li><a href="Products.php?category=Everyday">Ежедневни</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a>Аксесоари&nbsp;<i class="fas fa-caret-right"></i></a>
                            <div class="subdropdown">
                                <ul>
                                    <li><a href="Products.php?category=Headphones">Слушалки</a></li>
                                    <li><a href="Products.php?category=Keyboards">Клавиатури</a></li>
                                    <li><a href="Products.php?category=Mice">Мишки</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a href="Privacy.php">Поверителност</a></li>
            <li><a href="Contacts.php">Контакти</a></li>
            <li><a href="About.php">За Нас</a></li>

            <?php
                if (isset($_SESSION['user_id'])) {
                    if ($_SESSION['admin'] == 1) {
                        echo
                        '<li>
                            <a>Админ Панел&nbsp;<i class="fas fa-caret-down"></i></a>
                            <div class="dropdown" id="admin-dropdown">
                                <ul>
                                    <li><a href="ViewLaptops.php">Преглед Лаптопи</a></li>
                                    <li><a href="ViewAccessories.php">Преглед Аксесоари</a></li>
                                    <li><a href="ViewAccounts.php">Преглед Акаунти</a></li>
                                    <li><a href="ViewOrders.php">Преглед Поръчки</a></li>
                                </ul>
                            </div>
                        </li>';
                    }
                }

                echo
                '<li>
                    <form action="Products.php" class="search-box" method="POST">
                        <input name="search" placeholder="Търсене">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>';

                if (isset($_SESSION['user_id'])) {
                    echo
                    '<li class="float-right"><a href="Orders.php"><i class="fas fa-truck"></i></a></li>
                    <li><a href="Favourites.php"><i class="fas fa-heart"></i></a></li>
                    <li><a href="Cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                    <li><a href="Profile.php">' . $_SESSION['username'] . '</a></li>
                    <li><a href="./controllers/EndSession.php">Изход</a></li>';
                } else {
                    echo '<li class="float-right"><a href="Login.php">Вход</a></li>';
                }
            ?>
        </ul> <?php
    }

    function displayFooter() {
        echo
        '<div class="footer-container">
             <div class="social-icons">
                 <a href="https://www.facebook.com/profile.php?id=61558140324677" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                 <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                 <a href="https://twitter.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                 <a href="https://www.snapchat.com/" target="_blank"><i class="fa-brands fa-snapchat"></i></a>
                 <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
             </div>
             <div class="footer-nav">
                 <ul>
                     <li><a href="./">Начало</a></li>
                     <li><a href="Privacy.php">Поверителност</a></li>
                     <li><a href="Contacts.php">Контакти</a></li>
                     <li><a href="About.php">За Нас</a></li>
                 </ul>
             </div>
         </div>
         <div class="footer-bottom">
             <p>Alpha Laptop 2024 &copy; | Всички права запазени</p>
         </div>';
     }
?>