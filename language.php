<?php

$Lang = array(
  'he' => array(
      'lang_name' => 'עברית',
      'next_lang' => 'en',
      'lang_dir' => 'rtl',
      'similar' => 'דומה',
      'unsimilar' => 'לא דומה',
      'is_there_any_similarity' => 'האם יש דמיון כלשהו בין הצבעים?',
      'perceptual_color_diff' => 'הבדל צבעים תפישתי',
      'about' => 'אודות',
      'startquiz1' => 'התחל'
  ),
  'en' => array(
      'next_lang' => 'he',
      'lang_name' => 'English',
      'lang_dir' => 'ltr',
      'similar' => 'Similar',
      'unsimilar' => 'Unsimilar',
      'is_there_any_similarity' => 'Is there any similarity between these colors?',
      'perceptual_color_diff' => 'Perceptual Color Difference',
      'about' => 'About',
      'startquiz1' => 'Start'
  )
    
);
$lang_key = filter_input(INPUT_GET, 'lang');
if (!$lang_key || !isset($Lang[$lang_key])) {
    $lang_key = 'he';
}
$lang = $Lang[$lang_key];