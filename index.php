<?php
require_once 'include/eventos.inc.php';

$url = str_replace('/','',$_SERVER['REQUEST_URI']);
if( array_key_exists($url, $mensuales) ){
    Header('Location:'.$mensuales[$url]['link']);
    exit();
}

if( array_key_exists($url, $anuales) ){
    Header('Location:'.$anuales[$url]['link']);
    exit();
}

function print_bloque($evento) {
    ?>
    <div class="evento span5 well2" id="<?= $evento['id']; ?>">
        <h2 class="sub"><a href="<?= $evento['link']; ?>" target="_blank"><?= $evento['titulo']; ?></a></h2>
        <h4><?php if (isset($evento['subtitulo'])) {
        echo $evento['subtitulo'];
    } ?></h4>
        <ul class="unstyled">
            <?php if (!empty($evento['lugar']) && $evento['lugar'] != ''): ?>
            <li><i class="icon-map-marker"></i> <?= $evento['lugar']; ?></li>
            <?php endif; ?>
            <?php if (!empty($evento['fecha']) && $evento['fecha'] != ''): ?>
                <li><i class="icon-calendar"></i> <?= $evento['fecha']; ?></li>
            <?php endif; ?>
            <?php if (!empty($evento['horario']) && $evento['horario'] != ''): ?>
                <li><i class="icon-time"></i> <?= $evento['horario']; ?></li>
            <?php endif; ?>

            <?php if (!empty($evento['costo']) && $evento['costo'] != ''): ?>
                <li><i class="icon-money"></i> <?= $evento['costo']; ?></li>
            <?php endif; ?>

            <?php
            if (!empty($evento['links_otros']) && is_array($evento['links_otros']) && count($evento['links_otros']) > 0) {
                echo '<li class="otros-links"><i class="icon-share"></i> ';
                foreach ($evento['links_otros'] as $link_otro) {
                    echo '<span><a rel="tooltip" href="' . $link_otro['uri'] . '" target="_blank" alt="' . $link_otro['alt'] . '" title="' . $link_otro['alt'] . '">' . $link_otro['txt'] . '</a></span>'
                    ?>

                    <?php
                }
                echo '</li>';
            }
            ?>

            <?php
            if (!empty($evento['tags']) && $evento['tags'] != '') {
                echo '<li><i class="icon-tag"></i> ';
                $tags_array = explode(',', $evento['tags']);
                foreach ($tags_array as $tag) {
                    $tag = trim($tag);
                    echo '<span class="label label-info">' . $tag . '</span>'
                    ?>

                    <?php
                }
                echo '</li>';
            }
            ?>
        </ul>
    </div>
    <?php
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>#meetupUY - Índice de eventos de tecnología en Uruguay</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Indice de eventos relacionados con tecnología en Uruguay">
        <meta name="author" content="Diego Sapriza">
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="./css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <!--[if lt IE 8]>
          <link href="/css/font-awesome-ie7.css" rel="stylesheet">
        <![endif]-->
        <link href="./css/base.css" rel="stylesheet">
        <link href="./css/blue.css" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="./img/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./img/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./img/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./img/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" href="./img/ico/favicon.ico">
        <link href="./css/landing.css" rel="stylesheet">
    </head>

    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-primary btn-dropnav" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href=".">#meetupUY</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li><a href="http://twitter.com/meetupUY" target="_blank">@meetupUY</a></li>
                            <li><a href="mailto:info@meetup.uy">Contacto</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <h1>Eventos de tecnología en Uruguay:</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="span11">
                        <h2 class="txt-middle">Eventos anuales</h2>
                        <hr class="dashed">
                    </div>
                </div>
                <?php /*
                <div class="row">
                    <div class="span12">
                        <a href="http://tech.meetup.uy" style="display: inline-block; text-align: left; margin-bottom: 1.5em; width: 87%; margin-left: 1.6em;">
                            <img src="./img/banner_techmeetup.jpg">
                        </a>
                    </div>
                </div>
                */
                ?>
                <?php
                $anuales_chunks = array_chunk($anuales, 2);
                foreach ($anuales_chunks as $eventos_row):
                    ?>
                    <div class="row">
                        <?php
                        foreach ($eventos_row as $evento):
                            print_bloque($evento);
                        endforeach;
                        ?>
                    </div>
                    <?php
                endforeach;
                ?>
				<div class="row">
					<div class="span12" id="mc_embed_signup">
						<div class="callout well">
							<h2>Suscríbete a nuestra lista de correo:</h2>
							<p>Recibe periódicamente noticias sobre todos los eventos de tecnología de Uruguay.</p>
							<p>
								<form action="http://meetup.us6.list-manage.com/subscribe/post?u=3d41dcd85fce0148d40035e00&amp;id=73fa5346fb" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form-inline" target="_blank" novalidate>
									<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="dirección de correo" required>
									<input type="submit" value="Adentro!" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-primary">
								</form>
							</p>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="span12">
                        <h2 class="txt-middle"><a id="mensuales"></a>Eventos mensuales</h2>
                        <hr class="dashed">
                    </div>
                </div>
                <?php
                $mensuales_chunks = array_chunk($mensuales, 2);
                foreach ($mensuales_chunks as $eventos_row):
                    ?>
                    <div class="row">
                        <?php
                        foreach ($eventos_row as $evento):
                            print_bloque($evento);
                        endforeach;
                        ?>
                    </div>
                    <?php
                endforeach;
                ?>
                <!--
                <div class="row">
                    <div class="span12">
                        <div class="callout well">
                            <h2>Try our service free for 30 days</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit arcu massa, vehicula in felis.</p>
                            <a href="#" class="btn btn-primary btn-action">Get Started Now <i class="icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                -->
                <div class="row">
                    <div class="row12" style="text-align: center;">
                        <p>
                            <small>Las fechas / horarios / precios y lugares deben ser tomados de las páginas webs correspondientes a cada evento.</small>
                        </p>
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="span12">
                        <a href="#" style="display: inline-block; text-align: center; margin-bottom: 1.5em; width: 87%; margin-left: 1.6em;" target="_blank">
                            <img src="#">
                        </a>
                    </div>
                </div>
                -->
<!--
                <div class="row">
                    <div class="span12">
                        <h2 class="txt-middle">Google Calendar</h2>
                        <hr class="dashed">
                    </div>
                </div>

                <div class="row">
                    <div class="row8 offset1">
                        <iframe src="https://www.google.com/calendar/embed?src=centra.com.uy_uu1mo3ehptle6sb6iksdnaafb4%40group.calendar.google.com&title=Eventos%20TIC%20UY&amp;showPrint=0&amp;showCalendars=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;ctz=America%2FMontevideo" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>                    </div>
                </div>
-->
            </div>
        </div>
        <div id="copywrite">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <p>&copy; 2016 Meetup.UY - <a href="https://github.com/AV4TAr/meetupuy-landing" target="_blank">clone me</a> <span id="totop" class="pull-right">Back to Top <i class="icon-arrow-up"></i></span></p>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="./js/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/bootstrap-tooltip.js"></script>
        <script src="./js/jquery.tools.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#totop").click(function () {
                    $("body, html").animate({
                        scrollTop: 0
                    }, 300);
                    return false;
                });

                $(".otros-links a").tooltip();

                //$(".evento").click(function() {
                //    $(this).expose();
                //});

                <?php
                //$info = pathinfo($_SERVER['REQUEST_URI']);
                //echo '$("#'.$info['basename'].'").expose();';
                ?>
            });
        </script>

    </body>
</html>
