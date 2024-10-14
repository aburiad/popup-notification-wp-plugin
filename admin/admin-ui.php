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
            if (!isset($options['dtime'])) {
                $options['dtime'] = 10;
            }
            ?>
            <div class="formbold-mb-5">
                <label for="video_url" class="formbold-form-label"> Video URL </label>
                <input
                        type="url"
                        name="video_url"
                        value="<?php echo esc_attr($options['video_url']); ?>"
                        id="video_url"
                        placeholder="Video URL"
                        class="formbold-form-input"
                />
            </div>
            <div class="formbold-mb-5">
                <label for="dtime" class="formbold-form-label"> Display time </label>
                <input
                        type="number"
                        name="dtime"
                        value="<?php echo esc_attr($options['dtime']);?>"
                        id="dtime"
                        placeholder="Display time"
                        class="formbold-form-input"
                />
                <em style="display: block;margin: 10px 0">Enter the display time, for example enter number 24, which means that the Pop-up Video will be displayed once per visitor, and the Pop-up Video will be displayed again to the same visitor after the 24 hours. Default is "1" (1 = 1 hour). If you want to show the Pop-up Video to all visitors with each visit, leave this option blank</em>
            </div>
            <div class="formbold-mb-5 radio-input">
                <label class="formbold-form-label" for="homepage">Display Page</label>
                <div>
                    <label for="homepage">Home Page</label>
                    <input type="radio" name="selectpage" value="homepage" id="homepage"/>
                </div>
                <div>
                    <label for="enterwebsite">Enter Website</label>
                    <input type="radio" name="selectpage" value="enterwebsite" id="enterwebsite"/>
                </div>
                <div>
                    <label for="post">Post Only</label>
                    <input type="radio" name="selectpage" value="post" id="post"/>
                </div>
                <div>
                    <label for="page">Page Only</label>
                    <input type="radio" name="selectpage" value="page" id="page"/>
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
    $selectpage = isset($_POST['selectpage']) ? sanitize_text_field(wp_unslash($_POST['selectpage'])) : '';
    $dtime = isset($_POST['dtime']) ? sanitize_text_field(wp_unslash($_POST['dtime'])) : '';


    $options['video_url'] = $video_url;
    $options['selectpage'] = $selectpage;
    $options['dtime'] = $dtime;


    // Update the option in the database
    $encoded_data = serialize($options); // Use serialize instead of json_encode
    update_option('vp-options_data', $encoded_data);

    var_dump($encoded_data);
}
?>
