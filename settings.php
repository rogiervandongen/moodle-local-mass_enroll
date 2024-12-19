<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Mass enrol admin settings and defaults
 *
 * File         settings.php
 * Encoding     UTF-8
 *
 * @package     local_mass_enroll
 *
 * @copyright   2012 onwards Patrick Pollet
 * @copyright   2015 onwards R.J. van Dongen
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once(__DIR__ . '/lib.php');
require_once($CFG->libdir . '/accesslib.php');

if ($hassiteconfig) {
    $settings = new admin_settingpage('localsettingmassenroll', new lang_string('massenrollsettings', 'local_mass_enroll'));

    $settings->add(new admin_setting_heading('localmassenrolldefaults',
        get_string('localmassenrolldefaults', 'local_mass_enroll'),
        ''));


    $roles = role_get_names(null, ROLENAME_ALIAS, true);
    $settings->add(new admin_setting_configselect('local_mass_enroll/defaultrole',
        get_string('defaultrole', 'local_mass_enroll'),
        get_string('defaultrole_help', 'local_mass_enroll'),
        5, $roles));

    $yesno = [0 => get_string('no'), 1 => get_string('yes')];
    $settings->add(new admin_setting_configselect('local_mass_enroll/mailreportdefault',
        get_string('mailreportdefault', 'local_mass_enroll'),
        get_string('mailreportdefault_help', 'local_mass_enroll'),
        1,
        $yesno));

    $settings->add(new admin_setting_configcheckbox('local_mass_enroll/checknonmanualenrolments',
        get_string('checknonmanualenrolments', 'local_mass_enroll'),
        get_string('checknonmanualenrolments_help', 'local_mass_enroll'), 0));

    $settings->add(new admin_setting_configcheckbox('local_mass_enroll/enableextraunenrolmentplugins',
        get_string('enableextraunenrolmentplugins', 'local_mass_enroll'),
        get_string('enableextraunenrolmentplugins_help', 'local_mass_enroll'),
        0));

    $emethods = local_mass_enroll_get_enrolment_methods();
    $settings->add(new admin_setting_configmultiselect('local_mass_enroll/allowedunenrolmentmethods',
        get_string('allowedunenrolmentmethods', 'local_mass_enroll'),
        get_string('allowedunenrolmentmethods_help', 'local_mass_enroll'),
        [],
        $emethods));

    $settings->add(new admin_setting_heading('localmassenrollextensions',
        get_string('localmassenrollextensions', 'local_mass_enroll'),
        ''));

    $settings->add(new admin_setting_configcheckbox('local_mass_enroll/enablemassenrol',
        get_string('enablemassenrol', 'local_mass_enroll'),
        get_string('enablemassenrol_help', 'local_mass_enroll'), 1));

    $settings->add(new admin_setting_configcheckbox('local_mass_enroll/enablemassunenrol',
        get_string('enablemassunenrol', 'local_mass_enroll'),
        get_string('enablemassunenrol_help', 'local_mass_enroll'), 1));

    $ADMIN->add('localplugins', $settings);
}
