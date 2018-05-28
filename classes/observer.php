<?php

namespace local_mahara;

class observer {
    /**
     * Gets the service that handles things
     *
     * @return mahara_mnetservice
     */
    public static function get_service() {
        global $CFG;
        if (!class_exists('mahara_mnetservice')) {
            require_once $CFG->dirroot.'/local/mahara/mnetlib.php';
        }

        return new \mahara_mnetservice(-1);
    }

    /**
     * Handles when a user is removed from Moodle.
     * Fires the associated 'mahara_portfolio_deleted' event for plugins
     *
     * @param stdClass $user
     * @return boolean
     */
    public static function user_deleted(\core\event\base $event) {
        $data = $event->get_data();
        $user_id = $data['objectid'];
        $service = self::get_service();
        $portfolios = $service->get_users_portfolios($user_id);

        foreach ($portfolios as $portfolio) {
            $service->delete_portfolio($portfolio);
        }

      return true;
    }
}
