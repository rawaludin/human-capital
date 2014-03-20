<?php
/*
|--------------------------------------------------------------------------
| Macro bt_nav
|--------------------------------------------------------------------------
| Utility to create nav by notebook app template
| Usage : HTML::bt_nav($list);
| @param $list array with key 'url','icon','icon-bg','title','small','subnav'
|               'subnav'=> with key 'url' and 'title'
| Example : HTML::bt_nav(array(array('icon' => 'fa fa-dashboard icon',
            'icon-bg' => 'bg-danger', 'title' => 'Dashboard',
            'small' => true, 'url' => URL::to('dashboard'))
            );
*/
HTML::macro('bt_nav', function ($list) {
    $html = '';
    foreach ($list as $item) {
        $html_part = '';
        $create_nav = false;
        // check permission
        if (array_key_exists('visible', $item)) {
            if (!Sentry::getUser()->hasAccess($item['visible'])) {
                // this user doesn't have access to view this nav, delete this nav
                $html_part = '';
            } else {
                // user has permission
                $create_nav = true;
            }
        } else {
            // visible not set
            $create_nav = true;
        }

        // visible is not set. Or its been set, and user have access
        if ($create_nav) {
            // Check if current sub nav is active, if yes, make it parent active.
            $subnavActive = '';
            if (array_key_exists('subnav', $item)) {
                foreach ($item['subnav'] as $subnav) {
                    if ( Request::url() == $subnav['url'] ) {
                        $subnavActive = 'active';
                        break;
                    }
                }
            }
            $html_part .= '<li class="'.( Request::url() == $item['url']  || $subnavActive == 'active' ?  'active' : '') .'">';
            $html_part .= '  <a href="'.$item['url'].'" class="'.$subnavActive.'">';
            $html_part .= '    <i class="'.$item['icon'].'">';
            $html_part .= '      <b class="'.$item['icon-bg'].'"></b>';
            $html_part .= '    </i>';

            // Add icon for dropdown
            if (array_key_exists('subnav', $item)) {
                $html_part .= '<span class="pull-right">
                           <i class="fa fa-angle-down text"></i>
                           <i class="fa fa-angle-up text-active"></i>
                         </span>';
            }
            $html_part .= '    <span class="'.(array_key_exists('small', $item) && $item['small'] == true ? 'text-xxs' : '').'">'.$item['title'].'</span>';
            $html_part .= '  </a>';

            // Add subnav
            if (array_key_exists('subnav', $item)) {
                $html_part .= '<ul class="nav lt">';
                foreach ($item['subnav'] as $subnav) {
                    // filter visible subnav
                    // @TODO: if there is no visible allowed, don't add this parent menu
                    if (array_key_exists('visible', $subnav)) {
                        if (!Sentry::getUser()->hasAccess($subnav['visible'])) {
                            // this user doesn't have access to view this nav, delete this nav
                            $create_subnav = false;
                        } else {
                            // user has permission
                            $create_subnav = true;
                        }
                    } else {
                        // visible not set
                        $create_subnav = true;
                    }

                    // create subnav
                    if ($create_subnav) {
                        $html_part .= '<li class="'.( Request::url() == $subnav['url']  ?  'active' : '').'">';
                        $html_part .= '  <a href="'.$subnav['url'].'">';
                        $html_part .= '   <i class="fa fa-angle-right"></i>';
                        $html_part .= '      <span>'.$subnav['title'].'</span>';
                        $html_part .= '  </a>';
                        $html_part .= '</li>';
                    }
                }
                $html_part .= '</ul>';
            }
            $html_part .= '</li>';
        }
        // Append to $html
        $html .= $html_part;
    }

    return $html;
});
