// ============================================================
// AVAILABLE HOMES - EDIT THIS FILE TO UPDATE THE WEBSITE
// ============================================================
// To mark a home SOLD: change  available: true  to  available: false
// To add a home: copy a block, update the details.
// Photos: put photo files in /assets/img/homes/ and list the
// filenames in the photos array. If empty, the park photo is used.
// Price: use a number like 25000. For no price yet, use null and
// set  comingSoon: true
// ============================================================
const HOMES = [
  {
    park: "sturgis-commons",
    lot: "Lot 13",
    title: "1997 Dutch Park",
    specLine: "1997 Dutch Park · 2 bed / 1 bath · Downtown Sturgis",
    beds: 2, baths: 1,
    price: 15000,
    available: true,
    comingSoon: false,
    photos: [],
    notes: "This is the most affordable home we have right now. Downtown location, move-in ready. At $15,000 cash, you'd spend more than this on rent in the next 11 months, but at month 12, you'd have nothing to show for it.",
    financingNote: "Financing available through Triad, Vanderbilt, and PEP Lending."
  },
  {
    park: "sturgis-commons",
    lot: "Lot 25",
    title: "1992 Carrollton",
    specLine: "1992 Carrollton · 2 bed / 1 bath · Downtown Sturgis",
    beds: 2, baths: 1,
    price: 20000,
    available: true,
    comingSoon: false,
    photos: [],
    notes: "Same downtown location as Lot 13, slightly larger floor plan at $20,000. Own your own space, yard, driveway, front door for what most people around here spend on rent in 15 months."
  },
  {
    park: "sweet-lake",
    lot: "Lot 20",
    title: "1993 Fairmont",
    specLine: "1993 Fairmont · 2 bed / 1 bath · Lake views · Sturgis",
    beds: 2, baths: 1,
    price: 25000,
    available: true,
    comingSoon: false,
    photos: [],
    notes: "If you want quiet, this is it. Wooded setting, lake nearby, well-kept streets, and still just a short drive from Sturgis. $25,000 cash gets you out of a lease permanently."
  },
  {
    park: "sweet-lake",
    lot: "Lot 13",
    title: "1985 Schult - 14x70",
    beds: 3, baths: 2,
    price: null,
    available: true,
    comingSoon: true,
    photos: [],
    notes: "Coming soon - inquire for details."
  },
  {
    park: "sweet-lake",
    lot: "Lot 37",
    title: "1995 Mansion - 16x76",
    beds: null, baths: null,
    price: null,
    available: true,
    comingSoon: true,
    photos: [],
    notes: "Coming soon - inquire for details."
  },
  {
    park: "pine-crest",
    lot: "Lot 278",
    title: "1984 Redman - Double Wide",
    beds: 3, baths: 2,
    price: null,
    available: true,
    comingSoon: true,
    photos: [],
    notes: "Coming soon - inquire for details."
  },
  {
    park: "pine-crest",
    lot: "Lot 273",
    title: "1993 Redman - 16x76",
    beds: 3, baths: 2,
    price: null,
    available: true,
    comingSoon: true,
    photos: [],
    notes: "Coming soon - inquire for details."
  }
];
