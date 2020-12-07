<script src="../../assets/js/show-form-manage.js"></script>
<script src="../../assets/js/ajax.js"></script>
<script src="../../assets/js/cookie.js"></script>
<link rel="stylesheet" href="../../assets/css/poll-site.css">
<div class="container m-5 p-3 mx-auto border">
    <div class="card">
        <div class="card-header">
            <span class="text-uppercase font-size-7"><?= $data['poll']['poll_question']?></span>
        </div>
        <div class="card-body">
            <div class="m-2">
                <div class="mb-3">
                    <label for="" class="font-size-4">Enter name:</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="w-75 mb-3">
                <?php foreach($data['answers'] as $answer) : ?>
                    <label for="<?= $answer['id'] ?>" class="mx-3">
                        <input type="radio" name="<?= $data['poll']['uuid'] ?>" id="<?= $answer['id'] ?>"> <span class="font-size-5"><?= $answer['answer'] ?></span> 
                    </label>
                <?php endforeach; ?>
                </div>
            </div>
            <button class="btn btn-success ml-2 px-5">Vote</button>
            <hr class="my-4">
                <div class="card w-75 mx-auto">
                    <div class="card-header">
                        <span class="font-size-5 font-weight-bold">Results</span>
                    </div>
                    <div class="card-body">
                        <pre>
                            <?php print_r( $data ); ?>
                        </pre>
                    </div>
                </div>
        </div>
    </div>
</div>