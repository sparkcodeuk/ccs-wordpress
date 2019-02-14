<style>
    .text-white {
        color: white !important;
    }
</style>

<div style="text-align: center; margin-right: 20px; padding: 30px; background: #27A3DB;">
    <h1 class="text-white">CCS Salesforce import</h1>
    <p class="text-white">This process can take over 2 minutes to complete. Please be patient and don't leave the page when running.</p>


    <?php if ($imported) { ?>

        <h2 class="text-white">Import complete</h2>
        <p class="text-white">The import has completed successfully.</p>

        <div style="background: white; padding: 30px; ">

            <h3>Errors</h3>
            <ul>
                <? foreach ($response['errorCount'] as $objectName => $importCount) { ?>
                    <li><b><?php echo $objectName; ?></b>
                        - <?php echo $importCount; ?></li>
                <?php } ?>
            </ul>

            <h3>Successful imports</h3>
            <ul>
                <? foreach ($response['importCount'] as $objectName => $importCount) { ?>
                    <li><b><?php echo $objectName; ?></b>
                        - <?php echo $importCount; ?></li>
                <?php } ?>
            </ul>
        </div>

    <?php } else { ?>

        <form method="post">
            <button type="submit" class="button button-large">Run import
            </button>
        </form>

    <?php } ?>

</div>


