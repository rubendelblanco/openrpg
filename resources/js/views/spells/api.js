function SpellSuggestionAdapter (spells) {
    return spells.map(spell => ({
        id: spell.id,
        text: `LVL: ${spell.level} LIST: ${spell.list_name} NAME: ${spell.name}`,
        link: `/api/spells/${spell.id}`
    }));
}

const fetchSpellSuggestions = (payload) => {
    const search = new URLSearchParams({ q: payload })
    const url = `/api/spells/?${search.toString()}`;

    return new Promise((res, rej) => {
        fetch(url, {
            credentials: "same-origin",
        }).then(res => {
            if (res.ok) {
                return res.json()
            }
            throw new Error("unable to fetch spells");
        }).then(body => res(SpellSuggestionAdapter(body.data)))
        .catch(err => rej(err))
    });
}

module.exports = {
    fetchSpellSuggestions,
}