<?php
$test_number = $_GET['test'];
$test = json_decode(file_get_contents('tests/' . $test_number), true);

function correctAnswers($question)
{
    $correctAnswers = [];

    foreach ($question['answers'] as $key => $answer) {
        if ($answer['correct']) {
            $correctAnswers[] = $key;
        }
    }

    return $correctAnswers;
}

$p = false;
if (!empty($_POST)) {
    $p = true;
}
?>

<form method="post">
    <?php foreach ($test['questions'] as $questionId => $question): ?>

        <div>
            <h4><?php echo $question['question']; ?></h4>

            <?php $correctAnswers = correctAnswers($question); ?>
            <?php $type = count($correctAnswers) == 1 ? 'radio' : 'checkbox'; ?>
            <?php $m = isset($_POST['answer'][$questionId]) ? $_POST['answer'][$questionId] : []; ?>

            <?php foreach ($question['answers'] as $answerId => $answer): ?>
                <label>
                    <input type="<?php echo $type; ?>" name="answer[<?php echo $questionId; ?>][]"
                           value="<?php echo $answerId; ?>"<?php if ($m && in_array($answerId, $m)): ?> checked<?php endif; ?>>
                    <?php echo $answer['text']; ?>
                </label>
            <?php endforeach; ?>

            <?php if ($p): ?>
                <div>
                    <?php if (isset($_POST['answer'][$questionId])): ?>
                        <?php if (implode('', $_POST['answer'][$questionId]) === implode('', $correctAnswers)): ?>
                            <div style="color:green;">Верно</div>
                        <?php else: ?>
                            <div style="color:red;">Не верно</div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div style="color:red;">Ответ не получен</div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>

    <input type="submit" value="Отправить">
</form>
