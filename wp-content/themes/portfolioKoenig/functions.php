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

function get_github_repo_commits_info($username, $repo) {
    $api_url = "https://api.github.com/repos/{$username}/{$repo}/commits";
    $response = wp_remote_get($api_url, array('headers' => array('User-Agent' => 'WordPress')));
    if (is_wp_error($response)) {
        return false;
    }
    $body = wp_remote_retrieve_body($response);
    $commits = json_decode($body, true);

    if (!is_array($commits) || empty($commits)) {
        return array(
            'count' => 0,
            'last_commit' => 'Date non définie'
        );
    }

    $count = count($commits);
    $last_commit_date = isset($commits[0]['commit']['committer']['date']) ? date('d/m/Y', strtotime($commits[0]['commit']['committer']['date'])) : 'Date non définie';

    return array(
        'count' => $count,
        'last_commit' => $last_commit_date
    );
}

function get_github_repo_info($username, $repo) {
    $api_url = "https://api.github.com/repos/{$username}/{$repo}";
    $response = wp_remote_get($api_url, array('headers' => array('User-Agent' => 'WordPress')));
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
            $repo_name = isset($repo_info['name']) ? $repo_info['name'] : 'Nom non défini';
            $repo_language = isset($repo_info['language']) ? $repo_info['language'] : 'Langue non définie';
            $commits_info = get_github_repo_commits_info($username, $repo);
            $commits_count = isset($commits_info['count']) ? $commits_info['count'] : '0';
            $last_commit = isset($commits_info['last_commit']) ? $commits_info['last_commit'] : 'Date non définie';
            $repo_url = isset($repo_info['html_url']) ? $repo_info['html_url'] : '#';
            ?>
            <h2><?php echo esc_html($repo_name); ?></h2>
            <p><strong>Langage :</strong> <?php echo esc_html($repo_language); ?></p>
            <p><strong>Commits :</strong> <?php echo esc_html($commits_count); ?></p>
            <p><strong>Dernier commit :</strong> <?php echo esc_html($last_commit); ?></p>
            <p><a href="<?php echo esc_url($repo_url); ?>" target="_blank">Voir sur GitHub</a></p>
            <?php
        } else {
            echo '<p>Impossible de récupérer les informations du dépôt GitHub.</p>';
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('github_repo', 'display_github_repo');
