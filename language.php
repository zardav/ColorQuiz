<?php

$Lang = array(
  'he' => array(
      'lang_name' => 'עברית',
      'next_lang' => 'en',
      'lang_dir' => 'rtl',
      'similar' => 'דומה',
      'unsimilar' => 'לא דומה',
      'is_there_any_similarity' => 'האם יש דמיון בין הצבעים?',
      'please_answer_only_when' => 'אנא ענה/י "לא דומה" אך ורק אם הצבעים שונים לחלוטין.',
      'perceptual_color_diff' => 'דמיון בין צבעים',
      'about' => nl2br('שלום רב, לפניך שאלון על הבדל תפיסתי בין צבעים.
מטרת השאלון הינה לבנות מאגר מידע של זוגות צבעים ומהי רמת הדמיון בינהם.
מאגר המידע הזה ישמש על מנת לבחון פונקציות מרחק בין צבעים כנגד התפיסה האנושית של מרחק בין צבעים.
נודה מאד על מענה על מספר רב ככל הניתן של שאלות (גם מענה על מספר קטן של שאלות יעזור).
אנא ענה/י "לא דומה" אך ורק אם הצבעים שונים לחלוטין.

תודה מראש,

<div style="float: left";>דוד זר, סטודנט
ד"ר אופיר פלא, מנחה</div>'),
      'startquiz1' => 'התחל',
      'thanks!' => nl2br('תודה רבה על תשובותיכם.
כעת באפשרותכם לסגור את החלון, לחזור לתפריט או להמשיך לענות (נשמח מאד!)
ניתן לסגור את החלון בכל רגע, תשובותיכם ישמרו באופן אוטומטי.
תודה!'),
      'continue' => 'המשך לענות',
      'restart' => 'התחל מחדש',
      'menu' => 'תפריט',
      'question_back' => 'שאלה קודמת',
      'question' => 'שאלה',
      'og_description' => 'לפניכם שאלון על דמיון בין צבעים, נשמח אם תענו. השאלון פשוט, ידידותי וניתן להפסיק בכל רגע. מותאם גם לנייד.
נשמח אם תשתפו ותפיצו הלאה.
תודה!',
      'press_the_more_similar' => 'יש ללחוץ על הצבע שדומה יותר, ובמקרה שלא ניתן להחליט, ללחוץ על הצבע האמצעי.',
      'which_more_similar' => 'איזה מהצבעים דומה יותר לצבע האמצעי?'
  ),
  'en' => array(
      'next_lang' => 'he',
      'lang_name' => 'English',
      'lang_dir' => 'ltr',
      'similar' => 'Similar',
      'unsimilar' => 'Dissimilar',
      'is_there_any_similarity' => 'Is there similarity between these colors?',
      'please_answer_only_when' => 'Please answer "dissimilar" only if the colors are totally different.',
      'perceptual_color_diff' => 'Perceptual Color Difference',
      'about' => nl2br('This is a questionnaire on perceptual color difference.
The purpose of these questions is to gather a dataset of color pairs and their corresponding similarity.
This dataset will be used to test different color differences and compare them against perceptual color differences.
We would appreciate very much if you answer as many questions as possible (even answering several questions would be helpful).
Please answer "dissimilar" only if the colors are totally different.

Thanks in advance,

<div style="float: right";>David Zar, Student
Dr. Ofir Pele, Supervisor</div>'),
      'startquiz1' => 'Start',
      'thanks!' => nl2br('Thank you for your answers.
Now you can close the window, return to the menu or continue answering (which would be much appreciated!)
You can close the window at any time, your answers will be automatically saved.
Thanks!'),
      'continue' => 'Continue to answer',
      'restart' => 'Restart',
      'menu' => 'Menu',
      'question_back' => 'Previous question',
      'question' => 'Question',
      'og_description' => "This is a questionnaire on color difference. It's simple, friendly, and you can stop whenever you want. Compatible also with phone.
We would appreciate if you answer as many questions as possible and share this!
Thanks!",
      'press_the_more_similar' => 'Press the more similar color, or press the center color if you cannot decide.',
      'which_more_similar' => 'Which of these colors is more similar to the center color?'
  )
    
);
$lang_key = filter_input(INPUT_GET, 'lang');
if (!$lang_key || !isset($Lang[$lang_key])) {
    $lang_key = 'he';
}
$lang = $Lang[$lang_key];