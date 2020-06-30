<?php

//uruchamia style z motywu nadrzędnego
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css', array(), '3' );
}

function include_js_files() {

	wp_enqueue_script(
        'custom-script2',
        get_stylesheet_directory_uri() . '/js/slick/slick.min.js',
        array( 'jquery' )
    );
	
	wp_enqueue_style ('theme-style', get_stylesheet_directory_uri().'/js/slick/slick.css');

	wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/js/scripts.js',
        array( 'jquery' ), '13'
    );
}

add_action( 'wp_enqueue_scripts', 'include_js_files' );

function include_admin_js_files() {
    wp_enqueue_script(
        'custom-script4',
        get_stylesheet_directory_uri() . '/js/scripts-admin.js',
        array( 'jquery' ), '14'
    );
}
add_action( 'admin_enqueue_scripts', 'include_admin_js_files' );

function add_custom_meta_box($post){
	add_meta_box('so_meta_box', 'Zależne od kancelarii', 'zalezne_od_kancelarii', null, 'normal' , 'high');
	add_meta_box('so_meta_box2', 'Zależne od pracownika', 'zalezne_od_pracownika', null, 'normal' , 'high');
	add_meta_box('so_meta_box3', 'Funkcja pracownika', 'funkcja_pracownika', null, 'normal' , 'high');
	add_meta_box('so_meta_box5', 'Adres', 'adres', null, 'normal' , 'high');
	add_meta_box('so_meta_box6', 'Województwo', 'wojewodztwo', null, 'normal' , 'high');
	add_meta_box('so_meta_box7', 'Miasto', 'miasto', null, 'normal' , 'high');
	add_meta_box('so_meta_box8', 'Specjalizacje pracownika', 'specjalizacje_pracownika', null, 'normal' , 'high');
	add_meta_box('so_meta_box9', 'Zależne od kancelarii (gdy nie ma jej dodanej)', 'zalezne_od_kancelarii2', null, 'normal' , 'high');
}

add_action( 'add_meta_boxes', 'add_custom_meta_box' );

function get_custom_excerpt($words_count = 10){
	return '<p><a href="'.get_the_permalink().'">'.implode(' ', array_slice(explode(' ', get_the_excerpt()), 0, $words_count)).'...</a><a href="'.get_the_permalink().'" class="post-excerpt-more">więcej</a></p>';
}

function zalezne_od_kancelarii($post){
	
    $meta_element_class = get_post_meta($post->ID, 'zalezne_od_kancelarii', true); //true ensures you get just one value instead of an array  
    $args = array('category' => 2, 'numberposts'=>-1, 'orderby'=>'title', 'order'=>'ASC', 'post_status'=>array('draft', 'publish'));
    $posts = get_posts( $args );

    ?>   
    <label for="id_kancelarii">Kancelaria:  </label>

    <select name="id_kancelarii" id="id_kancelarii">
    	<option value=""></option>
    	<?php foreach($posts as $single_post): ?>
      		<option value="<?php echo $single_post->ID; ?>" <?php selected( $meta_element_class, $single_post->ID ); ?>><?php echo $single_post->post_title; ?></option>
      	<?php endforeach; ?>
    </select><br>
    <?php
}

function zalezne_od_kancelarii2($post){

    $meta_element_class = get_post_meta($post->ID, 'zalezne_od_kancelarii2', true); //true ensures you get just one value instead of an array  

    ?>   
    <label for="zalezne_od_kancelarii2">Wpisz: </label>
	<input type="text" id="zalezne_od_kancelarii2" name="zalezne_od_kancelarii2" value="<?php echo $meta_element_class; ?>">
	<br>
    <?php
}
	
function zalezne_od_pracownika($post) {
    $meta_element_class = get_post_meta($post->ID, 'zalezne_od_pracownika', true); //true ensures you get just one value instead of an array  
    $args = array('category' => 3, 'numberposts'=>-1, 'orderby'=>'title', 'order'=>'ASC', 'post_status'=>array('draft', 'publish'));
    $posts = get_posts( $args );
	$kancelaria_artykulu = get_post_meta($post->ID, 'zalezne_od_kancelarii');
    ?>   
    <label for="id_pracownika">Pracownik:  </label>

    <select name="id_pracownika" id="id_pracownika">
    	<option value=""></option>
    	<?php foreach($posts as $single_post): ?>
		<?php $kancelaria_pracownika = get_post_meta($single_post->ID, 'zalezne_od_kancelarii'); ?>
      		<option
      		
      		<?php
      			if(!empty($kancelaria_pracownika[0]) && !empty($kancelaria_artykulu[0]) && $kancelaria_pracownika[0]!=$kancelaria_artykulu[0])
					echo 'class="hidden" ';
      		?>
      		
      		 data-id-kancelarii="<?php echo !empty($kancelaria_pracownika[0]) ? $kancelaria_pracownika[0] : ''; ?>" value="<?php echo $single_post->ID; ?>" <?php selected( $meta_element_class, $single_post->ID ); ?>><?php echo $single_post->post_title; echo empty($kancelaria_pracownika[0]) ? ' (bez kancelarii)' : ''; ?></option>
      	<?php endforeach; ?>
    </select>
    <?php
}

function wojewodztwo($post){

    $meta_element_class = get_post_meta($post->ID, 'wojewodztwo', true); //true ensures you get just one value instead of an array  
	$wojewodztwa = array('dolnośląskie','kujawsko-pomorskie','lubelskie','lubuskie','łódzkie','małopolskie','mazowieckie','opolskie','podkarpackie','podlaskie','pomorskie','śląskie','świętokrzyskie','warmińsko-mazurskie','wielkopolskie','zachodniopomorskie');

    ?>   
    <label for="wojewodztwo">Wybierz: </label>

    <select name="wojewodztwo" id="wojewodztwo">
    	<option value=""></option>
    	<?php foreach($wojewodztwa as $wojewodztwo): ?>
      		<option value="<?php echo $wojewodztwo; ?>" <?php echo $wojewodztwo==$meta_element_class ? 'selected' : ''; ?>><?php echo $wojewodztwo; ?></option>
      	<?php endforeach; ?>
    </select><br>
    <?php
}

function funkcja_pracownika($post){

    $meta_element_class = get_post_meta($post->ID, 'funkcja_pracownika', true); //true ensures you get just one value instead of an array  

    ?>   
    <label for="funkcja_pracownika">Funkcja: </label>
	<br><textarea id="funkcja_pracownika" name="funkcja_pracownika"><?php echo str_replace('<br />', '', $meta_element_class); ?></textarea>
	<br>
    <?php
}

function miasto($post){

    $meta_element_class = get_post_meta($post->ID, 'miasto', true); //true ensures you get just one value instead of an array  

    ?>   
    <label for="miasto">Wpisz: </label>
	<input type="text" id="miasto" name="miasto" value="<?php echo $meta_element_class; ?>">
	<br>
    <?php
}

function specjalizacje($post){

    ?>   
    
    <input type="checkbox" id="prawo_spolek" name="prawo_spolek" <?php echo get_post_meta($post->ID, 'prawo_spolek', true)==1 ? 'checked' : ''; ?>> <label for="prawo_spolek">prawo spółek</label><br>
    <input type="checkbox" id="dzialalnosc_gospodarcza" name="dzialalnosc_gospodarcza" <?php echo get_post_meta($post->ID, 'dzialalnosc_gospodarcza', true)==1 ? 'checked' : ''; ?>> <label for="dzialalnosc_gospodarcza">działalność gospodarcza</label><br>
    <input type="checkbox" id="prawo_pracy" name="prawo_pracy" <?php echo get_post_meta($post->ID, 'prawo_pracy', true)==1 ? 'checked' : ''; ?>> <label for="prawo_pracy">prawo pracy</label><br>
    <input type="checkbox" id="podatki" name="podatki" <?php echo get_post_meta($post->ID, 'podatki', true)==1 ? 'checked' : ''; ?>> <label for="podatki">podatki</label><br>
    <input type="checkbox" id="ceny_transferowe" name="ceny_transferowe" <?php echo get_post_meta($post->ID, 'ceny_transferowe', true)==1 ? 'checked' : ''; ?>> <label for="ceny_transferowe">ceny transferowe</label><br>
    <input type="checkbox" id="kontakty_gospodarcze" name="kontakty_gospodarcze" <?php echo get_post_meta($post->ID, 'kontakty_gospodarcze', true)==1 ? 'checked' : ''; ?>> <label for="kontakty_gospodarcze">kontakty gospodarcze</label><br>
    <input type="checkbox" id="wlasnosc_intelektualna" name="wlasnosc_intelektualna" <?php echo get_post_meta($post->ID, 'wlasnosc_intelektualna', true)==1 ? 'checked' : ''; ?>> <label for="wlasnosc_intelektualna">własność intelektualna</label><br>
    <input type="checkbox" id="zamowienia_publiczne" name="zamowienia_publiczne" <?php echo get_post_meta($post->ID, 'zamowienia_publiczne', true)==1 ? 'checked' : ''; ?>> <label for="zamowienia_publiczne">zamówienia publiczne</label><br>
    <input type="checkbox" id="prawo_ochrony_konkurencji" name="prawo_ochrony_konkurencji" <?php echo get_post_meta($post->ID, 'prawo_ochrony_konkurencji', true)==1 ? 'checked' : ''; ?>> <label for="prawo_ochrony_konkurencji">prawo ochrony konkurencji</label><br>
    <input type="checkbox" id="projekty_infrastrukturalne" name="projekty_infrastrukturalne" <?php echo get_post_meta($post->ID, 'projekty_infrastrukturalne', true)==1 ? 'checked' : ''; ?>> <label for="projekty_infrastrukturalne">projekty infrastrukturalne</label><br>
    <input type="checkbox" id="inwestycje" name="inwestycje" <?php echo get_post_meta($post->ID, 'inwestycje', true)==1 ? 'checked' : ''; ?>> <label for="inwestycje">inwestycje</label><br>
    <input type="checkbox" id="transport" name="transport" <?php echo get_post_meta($post->ID, 'transport', true)==1 ? 'checked' : ''; ?>> <label for="transport">transport</label><br>
    <input type="checkbox" id="prawo_budowlane" name="prawo_budowlane" <?php echo get_post_meta($post->ID, 'prawo_budowlane', true)==1 ? 'checked' : ''; ?>> <label for="prawo_budowlane">prawo budowlane</label><br>
    <input type="checkbox" id="ochrona_srodowiska" name="ochrona_srodowiska" <?php echo get_post_meta($post->ID, 'ochrona_srodowiska', true)==1 ? 'checked' : ''; ?>> <label for="ochrona_srodowiska">ochrona środowiska</label><br>
    <input type="checkbox" id="prawo_bankowe" name="prawo_bankowe" <?php echo get_post_meta($post->ID, 'prawo_bankowe', true)==1 ? 'checked' : ''; ?>> <label for="prawo_bankowe">prawo bankowe</label><br>
    <input type="checkbox" id="prawo_karne_gospodarcze" name="prawo_karne_gospodarcze" <?php echo get_post_meta($post->ID, 'prawo_karne_gospodarcze', true)==1 ? 'checked' : ''; ?>> <label for="prawo_karne_gospodarcze">prawo karne gospodarcze</label><br>
    <input type="checkbox" id="postepowanie_sadowe" name="postepowanie_sadowe" <?php echo get_post_meta($post->ID, 'postepowanie_sadowe', true)==1 ? 'checked' : ''; ?>> <label for="postepowanie_sadowe">postępowanie sądowe</label><br>
    <input type="checkbox" id="dane_osobowe" name="dane_osobowe" <?php echo get_post_meta($post->ID, 'dane_osobowe', true)==1 ? 'checked' : ''; ?>> <label for="dane_osobowe">dane osobowe</label><br>
    <input type="checkbox" id="pozostale" name="pozostale" <?php echo get_post_meta($post->ID, 'pozostale', true)==1 ? 'checked' : ''; ?>> <label for="pozostale">pozostałe</label><br>
    <?php
}

function adres($post){

    $meta_element_class = get_post_meta($post->ID, 'adres', true); //true ensures you get just one value instead of an array  

    ?>   
	<textarea id="adres" name="adres"><?php echo str_replace('<br />', '', $meta_element_class); ?></textarea>
	<br>
    <?php
}

function specjalizacje_pracownika($post){

    $meta_element_class = get_post_meta($post->ID, 'specjalizacje_pracownika', true); //true ensures you get just one value instead of an array  

    ?>   
	<textarea id="specjalizacje_pracownika" name="specjalizacje_pracownika"><?php echo str_replace('<br />', '', $meta_element_class); ?></textarea>
	<br>
    <?php
}

add_action('save_post', 'save_custom_metaboxes');

function save_custom_metaboxes(){ 
    global $post;
    if(isset($_POST["id_kancelarii"])){
        $meta_element_class = $_POST['id_kancelarii'];
        update_post_meta($post->ID, 'zalezne_od_kancelarii', $meta_element_class);
    }
	
	if(isset($_POST["id_pracownika"])){
        $meta_element_class = $_POST['id_pracownika'];
        update_post_meta($post->ID, 'zalezne_od_pracownika', $meta_element_class);
    }
	
	if(isset($_POST["funkcja_pracownika"])){
        $meta_element_class = $_POST['funkcja_pracownika'];
        update_post_meta($post->ID, 'funkcja_pracownika', $meta_element_class);
    }
	
	$prawo_spolek = isset($_POST["prawo_spolek"]) ? 1 : 0;
    update_post_meta($post->ID, 'prawo_spolek', $prawo_spolek);
	
	$dzialalnosc_gospodarcza = isset($_POST["dzialalnosc_gospodarcza"]) ? 1 : 0;
    update_post_meta($post->ID, 'dzialalnosc_gospodarcza', $dzialalnosc_gospodarcza);
	
	$prawo_pracy = isset($_POST["prawo_pracy"]) ? 1 : 0;
    update_post_meta($post->ID, 'prawo_pracy', $prawo_pracy);
	
	$podatki = isset($_POST["podatki"]) ? 1 : 0;
    update_post_meta($post->ID, 'podatki', $podatki);
	
	$ceny_transferowe = isset($_POST["ceny_transferowe"]) ? 1 : 0;
    update_post_meta($post->ID, 'ceny_transferowe', $ceny_transferowe);
	
	$kontakty_gospodarcze = isset($_POST["kontakty_gospodarcze"]) ? 1 : 0;
    update_post_meta($post->ID, 'kontakty_gospodarcze', $kontakty_gospodarcze);
	
	$wlasnosc_intelektualna = isset($_POST["wlasnosc_intelektualna"]) ? 1 : 0;
    update_post_meta($post->ID, 'wlasnosc_intelektualna', $wlasnosc_intelektualna);
	
	$zamowienia_publiczne = isset($_POST["zamowienia_publiczne"]) ? 1 : 0;
    update_post_meta($post->ID, 'zamowienia_publiczne', $zamowienia_publiczne);
	
	$prawo_ochrony_konkurencji = isset($_POST["prawo_ochrony_konkurencji"]) ? 1 : 0;
    update_post_meta($post->ID, 'prawo_ochrony_konkurencji', $prawo_ochrony_konkurencji);
	
	$projekty_infrastrukturalne = isset($_POST["projekty_infrastrukturalne"]) ? 1 : 0;
    update_post_meta($post->ID, 'projekty_infrastrukturalne', $projekty_infrastrukturalne);
	
	$inwestycje = isset($_POST["inwestycje"]) ? 1 : 0;
    update_post_meta($post->ID, 'inwestycje', $inwestycje);
	
	$transport = isset($_POST["transport"]) ? 1 : 0;
    update_post_meta($post->ID, 'transport', $transport);
	
	$prawo_budowlane = isset($_POST["prawo_budowlane"]) ? 1 : 0;
    update_post_meta($post->ID, 'prawo_budowlane', $prawo_budowlane);
	
	$ochrona_srodowiska = isset($_POST["ochrona_srodowiska"]) ? 1 : 0;
    update_post_meta($post->ID, 'ochrona_srodowiska', $ochrona_srodowiska);
	
	$prawo_bankowe = isset($_POST["prawo_bankowe"]) ? 1 : 0;
    update_post_meta($post->ID, 'prawo_bankowe', $prawo_bankowe);
	
	$prawo_karne_gospodarcze = isset($_POST["prawo_karne_gospodarcze"]) ? 1 : 0;
    update_post_meta($post->ID, 'prawo_karne_gospodarcze', $prawo_karne_gospodarcze);
	
	$postepowanie_sadowe = isset($_POST["postepowanie_sadowe"]) ? 1 : 0;
    update_post_meta($post->ID, 'postepowanie_sadowe', $postepowanie_sadowe);
	
	$dane_osobowe = isset($_POST["dane_osobowe"]) ? 1 : 0;
    update_post_meta($post->ID, 'dane_osobowe', $dane_osobowe);
	
	$pozostale = isset($_POST["pozostale"]) ? 1 : 0;
    update_post_meta($post->ID, 'pozostale', $pozostale);
	

	if(isset($_POST["adres"])){
        $meta_element_class = nl2br($_POST['adres']);
        update_post_meta($post->ID, 'adres', $meta_element_class);
    }
	
	if(isset($_POST["specjalizacje_pracownika"])){
        $meta_element_class = nl2br($_POST['specjalizacje_pracownika']);
        update_post_meta($post->ID, 'specjalizacje_pracownika', $meta_element_class);
    }

	if(isset($_POST["wojewodztwo"])){
        $meta_element_class = $_POST['wojewodztwo'];
        update_post_meta($post->ID, 'wojewodztwo', $meta_element_class);
    }

	if(isset($_POST["miasto"])){
        $meta_element_class = $_POST['miasto'];
        update_post_meta($post->ID, 'miasto', $meta_element_class);
    }
	
	if(isset($_POST["zalezne_od_kancelarii2"])){
        $meta_element_class = $_POST['zalezne_od_kancelarii2'];
        update_post_meta($post->ID, 'zalezne_od_kancelarii2', $meta_element_class);
    }
}

function my_pre_get_posts( $query ) {

	if( $query->query['category_name']=='kancelarie' && !empty($_GET['wojewodztwo']) )
	{
		$query->set('meta_query', array(array(
										'key'     => 'wojewodztwo',
							            'value'   => $_GET['wojewodztwo'],
							            'compare' => '='
									)));
	}
	
	if( strpos($query->query['category_name'], 'artykuly')!==false && !empty($_GET['wszystkie']) )
	{
		$query->set('orderby', 'publish_date');
		$query->set('order', 'DESC');
	}
	
	if( $query->query['category_name']=='kancelarie')
	{
		$query->set('orderby', 'menu_order');
		$query->set('order', 'DESC');
	}

	return $query;

}

add_action('pre_get_posts', 'my_pre_get_posts');

 register_sidebar( array(
						  'name'          => __( 'Reklama pod menu', 'generic-child' ),
						  'id'            =>'undermenu-1',
						  'description'   => __( 'Wstaw tu obrazek', 'generic-child' ),
						  'before_widget' => '<div id="%1$s" class="widget %2$s">',
						  'after_widget'  => '</div>'
				  )
);
   
//add_action( 'widgets_init', 'register_widget_areas' ); 