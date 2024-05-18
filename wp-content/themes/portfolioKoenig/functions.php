<?php
function portfolioKoenig_enqueue_assets()
{
    // Enqueue styles
    wp_enqueue_style('portfolioKoenig-style', get_stylesheet_uri());
    wp_enqueue_style('index-style', get_template_directory_uri() . '/asset/css/index.css');

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('mon_script_js', get_stylesheet_directory_uri() . '/asset/js/mon_script.js', array('jquery'), '1.0', true);


}

add_action('wp_enqueue_scripts', 'portfolioKoenig_enqueue_assets');


function display_github_repos() {
    return '<div id="github-repos"></div>';
}
add_shortcode('github_repos', 'display_github_repos');

function get_github_repo_commits_info($username, $repo) {
    $api_url = "https://api.github.com/repos/{$username}/{$repo}/commits";
    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return false;
    }
    $body = wp_remote_retrieve_body($response);
    $commits = json_decode($body, true);
    
    $count = count($commits);
    $last_commit_date = $count > 0 ? date('d/m/Y', strtotime($commits[0]['commit']['committer']['date'])) : '';
    
    return array(
        'count' => $count,
        'last_commit' => $last_commit_date
    );
}
function get_github_repo_info($username, $repo) {
    $api_url = "https://api.github.com/repos/{$username}/{$repo}";
    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return false;
    }
    $body = wp_remote_retrieve_body($response);
    return json_decode($body, true);
}


function display_github_repo($atts) {
    $atts = shortcode_atts(array(
        'username' => 'sebus07', // Nom d'utilisateur GitHub par défaut
        'repo' => 'koukaki' // Nom du dépôt par défaut
    ), $atts);

    ob_start();
    ?>
    <div id="github-repo">
        <?php
        $username = $atts['username'];
        $repo = $atts['repo'];
        $repo_info = get_github_repo_info($username, $repo);
        if ($repo_info) {
            $commits_info = get_github_repo_commits_info($username, $repo);
            ?>
            <h2><?php echo esc_html($repo_info['name']); ?></h2>
            <p><strong>Language:</strong> <?php echo esc_html($repo_info['language']); ?></p>
            <p><strong>Commits:</strong> <?php echo esc_html($commits_info['count']); ?></p>
            <p><strong>Last Commit:</strong> <?php echo esc_html($commits_info['last_commit']); ?></p>
            <p><a href="<?php echo esc_url($repo_info['html_url']); ?>" target="_blank">Voir sur GitHub</a></p>

            <?php
        } else {
            echo '<p>Unable to retrieve GitHub repository information.</p>';
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('github_repo', 'display_github_repo');


