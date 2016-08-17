<?php # Minimum requirements: PHP7

function main() {
    $dex['json'] = file_get_contents('pgdex.json');
    $dex['array'] = json_decode($dex['json'], $array = true);

    foreach($dex['array'] as $mon) {
        if(!isset($mon['Next evolution(s)'])) {
            $name = strtolower($mon['Name']);
            $types = shortenTypes($mon['Types']);
            $fa = getAttTypes($mon['Fast Attack(s)']);
            $ca = getAttTypes($mon['Special Attack(s)']);

            $mdex[] = "$name ($types)$fa|$ca\n";
        }
    }

    sort($mdex, SORT_STRING);
    file_put_contents('microdex.txt', implode($mdex));
}

function getAttTypes($attacks) {
    foreach($attacks as $key => $value)
        $attacks[$key] = shortType($value['Type']??'-');

    return implode($attacks);
}

function shortenTypes($types) {
    foreach($types as $key => $value)
        $types[$key] = shortType($value);

    return implode($types);
}

function shortType($type) {
    switch($type) {
        case 'Normal': return 'N';
        case 'Fighting': return 'T';
        case 'Flying': return 'Y';
        case 'Poison': return 'P';
        case 'Ground': return 'G';
        case 'Rock': return 'R';
        case 'Bug': return 'B';
        case 'Ghost': return 'O';
        case 'Steel': return 'S';
        case 'Fire': return 'F';
        case 'Water': return 'W';
        case 'Grass': return 'A';
        case 'Electric': return 'E';
        case 'Psychic': return 'C';
        case 'Ice': return 'I';
        case 'Dragon': return 'D';
        case 'Dark': return 'K';
        case 'Fairy': return 'X';
        default: return '-';
    }
}

main();
