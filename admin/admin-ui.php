<div class="formbold-main-wrapper">
    <div class="formbold-form-wrapper">
        <form action="#" method="POST">
            <?php wp_nonce_field('pp_notification_nonce_action', 'pp_notification_nonce'); ?>
            <?php
            $data = get_option('vp-options_data');
            $options = maybe_unserialize($data);
            if (!isset($options['video_url'])) {
                $options['video_url'] = '';
            }
            ?>
            <div class="formbold-mb-5">
                <label for="name" class="formbold-form-label"> Video URL </label>
                <input
                        type="url"
                        name="video_url"
                        value="<?php echo esc_attr($options['video_url']); ?>"
                        id="video_url"
                        placeholder="Video URL"
                        class="formbold-form-input"
                />
            </div>
            <div class="formbold-mb-5 radio-input">
                <label class="formbold-form-label" for="homepage">Display Page</label>
                <div>
                    <span>Home Page</span>
                    <input type="radio" name="selectpage" value="homepage" id="homepage"/>
                </div>
                <div>
                    <span>Enter Website</span>
                    <input type="radio" name="seleectpage" value="enterwebsite" id="enterwebsite"/>
                </div>
                <div>
                    <span>Post Only</span>
                    <input type="radio" name="seleectpage" value="post" id="post"/>
                </div>
                <div>
                    <span>Page Only</span>
                    <input type="radio" name="seleectpage" value="page" id="page"/>
                </div>
                <div>
                    <span>Specefic Page</span>
                    <input type="radio" name="seleectpage" value="specefic" id="specefic"/>
                </div>
            </div>
            <button type="submit" name="submit" class="formbold-btn">Submit Data</button>
    </div>
    </form>
</div>
</div>

<?php

if (isset($_POST['submit']) && check_admin_referer('pp_notification_nonce_action', 'pp_notification_nonce')) {
    $video_url = isset($_POST['video_url']) ? sanitize_text_field(wp_unslash($_POST['video_url'])) : '';
    $seleectpage = isset($_POST['seleectpage']) ? sanitize_text_field(wp_unslash($_POST['seleectpage'])) : '';

    $options['video_url'] = $video_url;
    $options['seleectpage'] = $seleectpage;

    // Update the option in the database
    $encoded_data = serialize($options); // Use serialize instead of json_encode
    update_option('vp-options_data', $encoded_data);

    var_dump($encoded_data);
}


?>
