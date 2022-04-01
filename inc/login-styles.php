<?php

/* Customizing the login screen */

// Adding the logo
function rrc_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/rr-white-logo.png);
			height: 12.5rem;
			width: 20rem;
			background-size: 20rem 12.5rem;
			background-repeat: no-repeat;
		}
		
		body.login {
			background: #082f33;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'rrc_login_logo' );

// Changing the logo url
function rrc_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'rrc_login_logo_url' );

function rrc_login_logo_url_title() {
    return 'Riding Rapids';
}
add_filter( 'login_headertext', 'rrc_login_logo_url_title' );

// Changing login styles

function rrc_login_styles() { ?>
    <style type="text/css">
		body.login {
			background: #021c26;
		}

		body.login div#login form {
			border-radius: 4px;
		}

		body.login div#login p#nav a,
		body.login div#login p#backtoblog a {
    		color: #ffffff !important;
		}

		body.login div#login form#loginform p #wp-submit {
			background-color: #f29f05;
			color: #404040;
			border: 2px solid #f29f05;
		}

		body.login div#login form#loginform p #wp-submit:hover,
		body.login div#login form#loginform p #wp-submit:focus,
		body.login div#login form#loginform p #wp-submit:active {
			background-color: #a06903;
			border: 2px solid #a06903;
			color: #ffffff;
		}

		body.login .button.wp-hide-pw {
			color: #0e5158;
		}

		body.login .privacy-policy-link {
			color: #ffffff;
		}

    </style>
<?php }
add_action( 'login_enqueue_scripts', 'rrc_login_styles' );

add_editor_style();
add_theme_support( 'editor-styles' );