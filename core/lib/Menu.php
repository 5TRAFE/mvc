<?php
Class Menu {
    static function menuRender(){
         $categories = Categories::build();

        $menu = "<div id='cssmenu'><ul>
                    <li class='dropdown'><a>Главная</a></li>
                    <li class='has-sub'><a>Категории</a><ul>" . $categories  . "
           </ul> </li>
            </ul>
            </div>";

        return $menu;
    }


}