<?php

class RevisionStateFactory {

    private $revisionUnit = null;

    private $stateAttributes = [
//        'start_date' => 'Editable',
        'send_approval_date' => 'SendForApproval',
        'cancel_edit_date' => 'CancelledAuthor',
        'reject_date' => 'Rejected',
        'approve_date' => 'Approved',
        'proposed_to_release_date' => 'ReadyForRelease',
        'release_date' => 'Released',
        'end_date' => 'Cancelled',
    ];

    function __construct(CRevisionUnitActiveRecord $rU) {
        $this->revisionUnit = $rU;
    }
    

    public function getState() {
        $currentState = $this->getCurrentState();
        $className = get_class($this->revisionUnit) . $currentState . 'State';
         if ($currentState && (class_exists($className, true))) {
            return new $className($this->revisionUnit);
        }
        return new RevisionErrorState($this->revisionUnit);
    }

    private function getCurrentState() {
        $states = [];
        $statesFiltered = [];
        if ($this->revisionUnit->properties) {
            $states = $this->revisionUnit->properties->getAttributes(array_keys($this->stateAttributes));
            $statesFiltered = array_filter($states);
        }
        $currentState = null;
        foreach ($statesFiltered as $state=>$date) {
            if (!$currentState || date($date) >= date($states[$currentState])) {
                $currentState = $state;
            }
        }

        /* Костыль */
        if ($currentState == 'end_date' && $states["release_date"]!=null) {
            if($states["release_date"]>=$states["approve_date"])
            $currentState = 'release_date';
            else  $currentState = 'approve_date';
        }

        return $currentState ? $this->stateAttributes[$currentState] : 'Editable';
    }
}