<?php
class Processor_CashFlows_SftpCommunication extends Jobs_SftpCommunication
{
    public function __construct($JobType, $FilenamePattern, $LogJob, $Verbose)
    {
        parent::__construct(
            $JobType,
            $FilenamePattern,
            $LogJob,
            Jobs_Chargeback_Cashflows::CASHFLOWS_SFTP_FILE_LIVESPAN,
            $Verbose
        );
        $this->ProcessorName = 'CashFlows';
        $this->setDoneDir(Jobs_Chargeback_Cashflows::DIR_TYPE_DONE);
        $this->setCacheDir(Jobs_Chargeback_Cashflows::DIR_TYPE_CACHE);
    }

    public function setCommand($cmdDirectory)
    {
        $command = $cmdDirectory . DIRECTORY_SEPARATOR . "cashflows.sftp.exp " .
            Jobs_Chargeback_Cashflows::CASHFLOWS_SFTP_SERVER . ' ' .
            Jobs_Chargeback_Cashflows::CASHFLOWS_SFTP_PORT . ' ' .
            Jobs_Chargeback_Cashflows::CASHFLOWS_SFTP_SERVER_USERNAME . ' ' .
            Jobs_Chargeback_Cashflows::CASHFLOWS_SFTP_SERVER_PASSWORD;
            if ($this->Verbose) echo "SFTP command: " . $command . " \n ";
        parent::setCommand($command);
    }
    protected function getJobDirectory($JobType, $DirectoryType)
    {
        switch ($JobType) {
            case Jobs_Chargeback_Cashflows::JOB_TYPE_CBK:
                if ($DirectoryType == Jobs_Chargeback_Cashflows::DIR_TYPE_DONE) {
                    return Jobs_Chargeback_Cashflows::CASHFLOWS_CBK_COMPLETED_DIR;
                } else { // Cache
                    return Jobs_Chargeback_Cashflows::CASHFLOWS_CBK_DOWNLOAD_DIR;
                }
                break;
            case Jobs_Chargeback_Cashflows::JOB_TYPE_FRAUD:
                if ($DirectoryType == Jobs_Chargeback_Cashflows::DIR_TYPE_DONE) {
                    return Jobs_Chargeback_Cashflows::CASHFLOWS_FRAUD_COMPLETED_DIR;
                } else { // Cache
                    return Jobs_Chargeback_Cashflows::CASHFLOWS_FRAUD_DOWNLOAD_DIR;
                }
                break;
            case Jobs_Chargeback_Cashflows::JOB_TYPE_RECONCILE:
                if ($DirectoryType == Jobs_Chargeback_Cashflows::DIR_TYPE_DONE) {
                    return Jobs_Chargeback_Cashflows::CASHFLOWS_RECONCILE_COMPLETED_DIR;
                } else { // Cache
                    return Jobs_Chargeback_Cashflows::CASHFLOWS_RECONCILE_DOWNLOAD_DIR;
                }
                break;
            case Jobs_Chargeback_Cashflows::JOB_TYPE_RECONCILE:
                if ($DirectoryType == Jobs_Chargeback_Cashflows::DIR_TYPE_DONE) {
                    return Jobs_Chargeback_Cashflows::CASHFLOWS_RECONCILE_COMPLETED_DIR;
                } else { // Cache
                    return Jobs_Chargeback_Cashflows::CASHFLOWS_RECONCILE_DOWNLOAD_DIR;
                }
                break;
            default:
                throw new Exception('Unknown Job Type');
        }
    }
}

