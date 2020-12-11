<script src="../../assets/js/show-form-manage.js" type="module"></script>
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
                    <input type="text" name="user-name" id="user-name" class="form-control">
                </div>
                <div class="w-75 mb-3" id="answers">
                <?php foreach($data['answers'] as $answer) : ?>
                    <label for="<?= $answer['id'] ?>" class="mx-3">
                        <input type="radio" destination="vote" name="<?= $data['poll']['id'] ?>" id="<?= $answer['id'] ?>"> <span class="font-size-5"><?= $answer['answer'] ?></span> 
                    </label>
                <?php endforeach; ?>
                </div>
            </div>
            <button class="btn btn-success ml-2 px-5" id="vote">Vote</button>
            <hr class="my-4">
                <div class="card ml-3 mr-3 mx-auto">
                    <div class="card-header">
                        <span class="font-size-5 font-weight-bold">Results</span>
                    </div>
                    <div class="card-body">
                        <input type="hidden" wss-addr="ws://<?= WSS['HOST'].':'.WSS['PORT'] ?>" poll-id="<?= $data['poll']['id'] ?>" id="add-data">
                        <div id="vote-data" class="row align-items-center justify-content-center">Waiting...</div>
                    </div>
                </div>
        </div>
    </div>
    <a href="../../" class="btn btn-success my-3">Back to main page</a>
</div>