<!-- <script src="assets/js/main-form-manage.js"></script>
<script src="assets/js/main-form-req.js"></script> -->
<link rel="stylesheet" href="../../assets/css/poll-site.css">
<div class="container m-5 p-3 mx-auto border">
    <div class="card">
        <div class="card-header">
            <h2 class="text-uppercase"><?= $data['poll']['poll_question']?></h2>
        </div>
        <div class="card-body">
            <div class="">
                <?php foreach($data['answers'] as $answer) : ?>
                    <label for="<?= $answer['id'] ?>">
                        <input type="radio" name="<?= $data['poll']['uuid'] ?>" id="<?= $answer['id'] ?>"> <span class="font-size-5"><?= $answer['answer'] ?></span> 
                    </label>
                    <br>
                <?php endforeach; ?>
                <button class="btn btn-success">Vote</button>
            </div>
            <!-- <pre>
                <?php print_r( $data ); ?>
            </pre> -->
            <hr>
            <div class="container m-5 p-3">
                asdasd
            </div>
        </div>
    </div>
</div>