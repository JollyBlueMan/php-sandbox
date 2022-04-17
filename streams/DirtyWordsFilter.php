<?php


class DirtyWordsFilter extends php_user_filter
{
    public function filter($in, $out, &$consumed, $closing)
    {
        $words = ['grime', 'dirt', 'grease'];
        $wordData = [];

        foreach ($words as $word) {
            $replacement = array_fill(0, mb_strlen($word), '*');
            $wordData[$word] = implode('', $replacement);
        }

        $bad = array_keys($wordData);
        $good = array_values($wordData);

        // Iterate each bucket
        while ($bucket = stream_bucket_make_writeable($in)) {
            // Censor dirty words
            $bucket->data = str_replace($bad, $good, $bucket->data);

            // increment total data consumed
            $consumed += $bucket->datalen;

            // send bucket to downstream brigade
            stream_bucket_append($out, $bucket);
        }

        // Return the code that indicates that the userspace filter returned buckets in $out
        return PSFS_PASS_ON;
    }
}