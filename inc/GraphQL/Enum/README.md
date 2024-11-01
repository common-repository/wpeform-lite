The reasons why we don't create nested namespaces for `enum` is

- `ENUM` is top level for GraphQL.
- So we need to properly think about names when creating `ENUM`s.
- Having all enums in a single non-nested directory helps us do so.

**So don't create ENUM in nested namespaces.**
