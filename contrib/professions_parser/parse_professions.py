#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import json
import csv
import unidecode
import glob
import itertools
import slugify


profession_files = glob.glob("./professions/*.txt")
separator = "\t"
professions_data = {}

def sticks_to_snakes(payload):
    return slugify.slugify(payload)

def sanitize(payload):
    return unidecode.unidecode(payload.strip())

def split_by(payload, sep=separator):
    return [sanitize(item) for item in payload.split(sep)]

def make_dict(payload, keys):
    return dict(list(zip(keys, payload)))

def read_profession(p_file):
    result = []
    with open(p_file, 'r') as fp:
        content = fp.readlines()
        content = [line for line in content
                   if not (line.startswith("#") and not line.startswith("##"))]
        for line in content:
            m_line = line.strip()
            if m_line:
                result.append(m_line)
    return result[1:]


def parse_profession(profession_name, content):
    parse_index = 1
    last_index = 0
    payload = []
    result = {}
    for index, line in enumerate(content):
        if "####" in line:
            lines = content[last_index:index]
            last_index = index + 1
            data = parsing_indexes[parse_index](lines)
            parse_index += 1
            if parse_index >= len(parsing_indexes):
                break
            payload = []
            if data:
                result.update(data)
            continue
        payload.append(line)
    return result


def parse_features(content):
    # only the first 2 features
    features = content[0].strip().split(" ")[:2]
    return {"features": features}


def parse_realms(content):
    realms_map = {
        "Mentalismo": "Men",
        "Esencia": "Ese",
        "Canalización": "Can",
        "Arcano": "Arc"
    }
    return {"realms": [realms_map[realm.strip()] for realm in content[0].split("/")]}


def parse_bonuses(content):
    return {
        "profession_bonus": [
            make_dict(split_by(line), keys=("prof", "bonus"))
            for line in content
        ]
    }


def parse_category_skills(content):
    return {
        "skill_category_ranges": [
            make_dict(split_by(line), keys=("skill_cat", "ranges"))
            for line in content
        ]
    }


def parse_common_skills(content):
    return {"common_skills": [sanitize(line) for line in content if line != "Ninguna"]}

def parse_professional_skills(content):
    return {"professional_skills": [sanitize(line) for line in content if line != "Ninguna"]}

def parse_restricted_skills(content):
    return {"restricted_skills": [sanitize(line) for line in content if line != "Ninguna"]}

def parse_spells(content):
    spells = [make_dict(split_by(line), keys=("spell", "level", "ranges"))
              for line in content]
    spells_iter = itertools.groupby(spells, key=lambda spell: spell["spell"])
    return {
        "spells_development": [
            {
                "spell": spell_name,
                "developments": list(group)
            }
            for spell_name, group in spells_iter
        ]
    }

def parse_training_packs(content):
    return {
        "training_packs": [
            make_dict(split_by(line), keys=("pack", "points"))
            for line in content
        ]
    }


parsing_indexes = {
    1: parse_features,
    2: parse_realms,
    3: parse_bonuses,
    4: parse_category_skills,
    5: parse_common_skills,
    6: parse_professional_skills,
    7: parse_restricted_skills,
    8: parse_spells,
    9: parse_training_packs
}

def main():
    for profession_file in profession_files:
        base_name = os.path.basename(profession_file)
        if "." in base_name:
            base_name, _ = base_name.split(".")
        profession_name = sticks_to_snakes(base_name)
        content = read_profession(profession_file)
        prof_data =  parse_profession(profession_file, content)
        professions_data[profession_name] = prof_data


    # Dump data to file
    with open("./out/professions.json", "w+", encoding="utf-8") as fp:
        fp.write(json.dumps(professions_data, indent=4))

if __name__ == '__main__':
    main()
