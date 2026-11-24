# Decision log

The canonical record of **why** this repository is the way it is: the reasoning and the **rejected alternatives** behind decisions that have closed. It is the guard against silently relitigating a settled decision.

**Consult it before acting.** Before proposing a change, reopening a question, or picking an approach, check here first: the path under consideration may already be a decided-and-recorded one, or an explicitly rejected one. If it is, follow the record (or make the case to revisit it); do not quietly re-decide.

**When a seam closes, record the verdict in both places.** Capture the *what*, *why* and rejected alternatives **here** (the cross-ticket index) **and** in the GitHub issue's `## Decision` section (the per-ticket record), keeping the two in sync. This file does not replace the issue tracker, which stays the system of record for a single ticket's status.

See the [`design-decision-forks`](../.claude/rules/design-decision-forks.md) rule for how a fork is surfaced and driven to resolution before its verdict lands here.

## How to add an entry

Oldest first, one entry per closed decision, so **a new entry is appended to the end of the file**. Keep it terse; the issue carries the depth. Each entry is preceded by exactly one blank line, which `scripts/check-decision-log-order.mjs` enforces along with the date order. The file is marked `merge=union` in `.gitattributes`, so two branches that each append an entry merge without a conflict.

```markdown
## YYYY-MM-DD: <short decision title> (<#issue or area>)

**Decision.** <what was decided, in a sentence or two>

**Why.** <the reasoning that settled it>

**Rejected.** <the alternatives considered, and why each lost>

**Companion.** <link to the GitHub issue holding the full reasoning>
```

---

## 2026-11-24: Started from the add-on template as `uams-web/aether-blueprint-labels` (repository setup)

**Decision.** This repository started from `UAMS-Web/statamic-addon-template` and is the package `uams-web/aether-blueprint-labels`, namespace `UAMSWeb\Aether\BlueprintLabels`. It has no settings, so the template's placeholder config file and its test were deleted rather than renamed. It carries no `LICENSE`, and `composer.json` has no `license` field.

**Why.** The add-on holds two per-blueprint create labels that `UAMS-Web/patches-statamic-cms` keeps as patches, and the rename lands once so the two feature pull requests do not collide on it. The shared rules and skills reach the repository by onboarding it to the sync in `UAMS-Web/uams-claude-skills` rather than by a copied snapshot that goes stale. The license waits on the general decision from UAMS legal in `UAMS-Web/uams-statamic#261`.

**Rejected.** Keeping a renamed, empty config file: it would publish a file with no setting in it and need a test that pins nothing. Snapshotting the synced files into the repository: every add-on would begin with a stale copy that conflicts with its first sync pull request. Copying a license from an existing add-on: legal has not decided which license applies.

**Companion.** `UAMS-Web/aether-blueprint-labels#1` and `UAMS-Web/uams-statamic#261`.

---

## 2026-11-24: Licensed under MIT, as the other Aether add-ons are (licensing)

**Decision.** The add-on carries the MIT license, held by the University of Arkansas for Medical Sciences, as `LICENSE` at the root and `"license": "MIT"` in `composer.json`. The text is identical to `UAMS-Web/aether-people`'s. This supersedes the earlier entry's note that the license waits on `UAMS-Web/uams-statamic#261`.

**Why.** The repository is public, and GitHub reports no license for one without a license file. `UAMS-Web/aether-people` and `UAMS-Web/aether-redirects` already ship the MIT license under the same holder.

**Rejected.** Waiting for the general decision from UAMS legal: the sibling add-ons already ship MIT, and a public repository with no license grants no rights to its users.

**Companion.** `UAMS-Web/aether-blueprint-labels#4`.
