Where the add-on is developed and how to report a problem.

- [Repository](https://github.com/UAMS-Web/aether-blueprint-labels)
- [Report a problem](https://github.com/UAMS-Web/aether-blueprint-labels/issues)
- [Releases](https://github.com/UAMS-Web/aether-blueprint-labels/releases)

## Developing the add-on

- [Development loop against a host](https://github.com/UAMS-Web/aether-blueprint-labels/blob/main/docs/DEVELOPMENT.md): exercising the add-on in a Statamic host.
- [Decision log](https://github.com/UAMS-Web/aether-blueprint-labels/blob/main/docs/DECISIONS.md): why the add-on works the way it does, with the alternatives that lost.
- [Contributing](https://github.com/UAMS-Web/aether-blueprint-labels/blob/main/CONTRIBUTING.md): the path from an issue to a merged pull request.

## How it is tested

The Integration suite boots a minimal Statamic through Testbench and covers each case in the [Reference](Reference.md). Line coverage of `src/` is 100%, and the full mutation pass runs weekly, Mondays at 07:17 UTC.
