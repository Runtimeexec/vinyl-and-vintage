<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
            <h1>Inventory</h1>
<?php
//$throttle = Discogs\ClientFactory::factory([]);
//$client->getHttpClient()->getEmitter()->attach(new Discogs\Subscriber\ThrottleSubscriber());


//$response = Discogs\ClientFactory::factory([]);
//$releases = $response->getReleases([
    //'username' => 'itsforyoumusic',
    //'folder_id' => 0
//]);

  

// init curl object        
$ch = curl_init();

// define options
$optArray = array(
    CURLOPT_URL => 'https://api.discogs.com/users/itsforyoumusic/inventory?sort=listed&sort_order=desc&per_page=100',   
    CURLOPT_RETURNTRANSFER => true
);

// apply those options
curl_setopt_array($ch, $optArray);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_USERAGENT, 'vinyl-and-vintage-app/0.1 + http://vinylandvintage.co.uk');

// execute request and get response
$releases = curl_exec($ch);
curl_close($ch);

$json = json_decode($releases);

//echo $releases;
//$array1 = $json->{'releases'};
//
//echo $array1;
//
//echo $arrlength = count($array1);
//
//for($x = 0; $x < $arrlength; $x++) {
// $array2 =  $array1[$x]->{'basic_information'} -> {'artists'};
// 
// for($y = 0; $y < count($array2); $y++) {
//   $name = $array2[$y]->{'name'};
//   echo 'Artist Name: ';
//   echo $name;
//   
// }
//   echo "<br>";
//}


//var_dump($json);
//$name=$json['releases']['']['basic_information']['artists']['name'];

//echo $name;


// $pagination = $json->{'pagination'};
//        print '$per_page: ' . $per_page = $pagination->{'per_page'};
//        echo '<br />';
//        print '$items: ' . $items = $pagination->{'items'};
//        echo '<br />';
//        print '$page: ' . $page = $pagination->{'page'};
//        $urls = $pagination->{'urls'};
//        echo '<br />';
//        print '$last: ' . $last = $urls->{'last'};
//        echo '<br />';
//        print '$next: ' . $next = $urls->{'next'};
//        echo '<br />';
//        print '$pages: ' . $pages = $pagination->{'pages'};
//        echo '<br />';
////echo 'Current PHP version: ' . phpversion();
//        echo '<br />';

        $listings = $json->{'listings'};
        $arrlength = count($listings);
        
        echo '<h2>Top 100 Most Recent listings</h2>';
        echo '<table id="table1" cellpadding=10 style="text-align:left">';
echo '<thead><tr><th>Description</th><th>ID</th><th>Price (GBP)</th><th></th></tr></thead><tbody>';
        
        for ($x = 0; $x < $arrlength; $x++) {
            echo '<tr>';
//            echo '<td>';
//            print 'status: ' . $listings[$x]->{'status'};
//            echo '</td>';
            
            
            echo '<td>';
            //print 'release: ' . $listings[$x]->{'release'}->{'catalog_number'} . ' ' . $listings[$x]->{'release'}->{'resource_url'} . ' ' . $listings[$x]->{'release'}->{'year'} . ' ' . $listings[$x]->{'release'}->{'id'} . ' ' . $listings[$x]->{'release'}->{'description'};
            print $listings[$x]->{'release'}->{'description'};
            echo '</td>';
            
            echo '<td>';
            print $listings[$x]->{'id'};
            echo '</td>';
            
            
            
            echo '<td>';
            $price = $listings[$x]->{'price'}->{'currency'} . ' ' . $listings[$x]->{'price'}->{'value'};
            print $price;
            echo '</td>';
//            echo '<td>';
//            print 'allow_offers:  ' . $listings[$x]->{'allow_offers'};
//            echo '</td>';
//            echo '<td>';
//            print 'sleeve_condition: ' . $listings[$x]->{'sleeve_condition'};
//            echo '</td>';
            
//            echo '<td>';
//            print 'condition: ' . $listings[$x]->{'condition'};
//            echo '</td>';
//            echo '<td>';
//            print 'posted: ' . $listings[$x]->{'posted'};
//            echo '</td>';
//            echo '<td>';
//            print 'ships_from: ' . $listings[$x]->{'ships_from'};
//            echo '</td>';
            echo '<td>';
            print '<a href="' . $listings[$x]->{'uri'} . '" target="_blank">View item on Discogs.com</a>';
            echo '</td>';
//            echo '<td>';
//            print 'comments: ' . $listings[$x]->{'comments'};
//            echo '</td>';
//            echo '<td>';
//            print 'seller: ' . $listings[$x]->{'seller'}->{'username'} . ' ' . $listings[$x]->{'seller'}->{'id'} . ' ' . $listings[$x]->{'seller'}->{'resource_url'};
//            echo '</td>';            
//            echo '<td>';
//            print 'resource_url: ' . $listings[$x]->{'resource_url'};
//            echo '</td>';
//            echo '<td>';
//            print 'audio: ' . $listings[$x]->{'audio'};
//
//
//            echo '</td>';
            echo '</tr>';
            
//            echo '<br />';
//            echo '<br />';
// for($y = 0; $y < count($array2); $y++) {
//   $name = $array2[$y]->{'name'};
//   echo 'Artist Name: ';
//   echo $name;
//   
// }
//   echo "<br>";
//};
        }
echo '</tbody></table>';
        
        ?>


<script>



$(document).ready(function() {

    $('table#table1').DataTable();

} );



</script>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
