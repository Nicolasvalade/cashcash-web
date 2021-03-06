<?php function get_msg_erreur($code_erreur)
{
    switch ($code_erreur) {
        case "":
            return "";

            // tech/interv_valid
        case "tiv1":
            return "Aucun matériel.";
        case "tiv2":
            return "Erreur de la mise à jour.";

            // admin/interv_details
        case "aid1":
            return "Choisissiez un technicien valide.";

            // admin/interv_edit
        case "aie1":
            return "Choisissez une date et une heure valides.";
        case "aie2":
            return "Choisissiez un technicien valide.";
        case "aie3":
            return "Echec de la modification.";

            // admin/interv_nouv
        case "ain1":
            return "Choisissiez un client valide.";
        case "ain2":
            return "Choisissez une date et une heure valides.";
        case "aie3":
            return "Echec de la création.";

            // admin/interv_nouv
        case "ail1":
            return "Intervention créée avec succès.";

    }
}
