<style>
    .text-white {
        color: white !important;
    }
</style>

<div style="text-align: center; margin-right: 20px; padding: 30px; background: #27A3DB;">
    <h1 class="text-white">CCS Salesforce import</h1>


    <?php if ($imported) { ?>

        <h2 class="text-white">Import complete</h2>
        <p class="text-white">The import has completed successfully. <?php echo $importCount ?> Frameworks have been imported.</p>

    <?php } else { ?>

        <form method="post">
            <button type="submit" class="button button-large">Run import</button>
        </form>

    <?php } ?>

</div>


