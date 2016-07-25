$project_id = '116539753/';
$project_url = 'http://scratch.mit.edu/projects/' . $project_id;
$api_url = 'http://scratch.mit.edu/site-api/comments/project/' . $project_id . '?page=1&salt=' . md5(time()); //salt is to prevent caching

$data = file_get_contents($api_url);
    if (!$data) {
        echo '<p>API access failed. Please try again later.</p>';
        return;
    }
    $success = false;
    preg_match_all('%<div id="comments-\d+" class="comment.*?" data-comment-id="\d+">.*?<a href="/users/(.*?)">.*?<div class="content">(.*?)</div>%ms', $data, $matches);
    foreach ($matches[2] as $key => $val) {
        $user = $matches[1][$key];
        $comment = trim($val);
        if ($user == $requested_user /* this variable needs to represent the username you're looking for */ && $comment == $verification_code /* whatever verification code you're looking for */) {
            $success = true;
            echo 'logged in. You can close this now.'
            break;
        }
    }
