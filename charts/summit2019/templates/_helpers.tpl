{{/* Generate home url */}}
{{- define "summit2019.home" -}}
{{- if eq .Values.environment "production" -}}
https://{{ .Values.domain }}
{{- else -}}
https://{{ .Values.environment }}.{{ .Values.domain }}
{{- end -}}
{{- end -}}

{{/* Return namespace */}}
{{- define "summit2019.namespace" -}}
{{- if eq .Values.environment "production" -}}
default
{{- else -}}
{{ .Values.environment }}
{{- end -}}
{{- end -}}

{{/* Return dns names for certificates */}}
{{- define "summit2019.dnsName" -}}
{{- if eq .Values.environment "production" -}}
{{ .Values.domain }}
{{- else -}}
{{ .Values.environment }}.{{ .Values.domain }}
{{- end -}}
{{- end -}}
