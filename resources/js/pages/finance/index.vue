<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'

import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import Button from '@/components/ui/button/Button.vue';
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Check } from 'lucide-vue-next';

const page = usePage();

// table component
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableFooter,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Finance',
        href: '/finance',
    },
];

const form = useForm({
    account: '',
    amount: '',
})

const handleSubmit = () => {
    form.post('/finance');
}

</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div v-if="page.props.flash?.message" class="alert">
                    <Alert class="bg-green-200 text-black">
                        <Check color="#1f1f1f" />
                        <AlertTitle>Successful</AlertTitle>
                        <AlertDescription>
                            {{ page.props.flash?.message }}
                        </AlertDescription>
                    </Alert>
                </div>
                <br />
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <PlaceholderPattern />savings
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <PlaceholderPattern />income
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <PlaceholderPattern />expense
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border p-4">

                <br />
                

                <form @submit.prevent="handleSubmit" class="w-4/12 space-y-6 p-4 border rounded-xl">
                    <h1>Add income to account</h1>
                    <!-- Account -->
                    <div class="space-y-4">
                        <Label for="account">Account</Label>
                        <Input type="text" placeholder="Cash" name="account" v-model="form.account" />
                        <div class="text-sm text-red-600" v-if="form.errors.account">{{ form.errors.account }}</div>
                    </div>
                    <!-- Amount -->
                    <div class="space-y-4">
                        <Label for="amount">Amount</Label>
                        <Input type="number" placeholder="500" name="amount" v-model="form.amount" />
                        <div class="text-sm text-red-600" v-if="form.errors.amount">{{ form.errors.amount }}</div>
                    </div>
                    <Button type="submit" :disabled="form.processing">Add income</Button>
                </form>
                <br />

                <Table>
                    <TableCaption>A list of your recent invoices.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">
                                Invoice
                            </TableHead>
                            <TableHead>Status</TableHead>
                            <TableHead>Method</TableHead>
                            <TableHead class="text-right">
                                Amount
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow>
                            <TableCell class="font-medium">
                                INV001
                            </TableCell>
                            <TableCell>Paid</TableCell>
                            <TableCell>Credit Card</TableCell>
                            <TableCell class="text-right">
                                $250.00
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>


<!-- FORM -->
<!-- 
import { toTypedSchema } from "@vee-validate/zod"
import { h } from "vue"
import * as z from "zod"

                import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form"
import { Input } from "@/components/ui/input"
import { toast } from "vue-sonner"

const formSchema = toTypedSchema(z.object({
  amount: z.coerce.number().int().min(1),
}))

function onSubmit(values: any) {
  toast({
    title: "You submitted the following values:",
    description: h("pre", { class: "mt-2 w-[340px] rounded-md bg-slate-950 p-4" }, h("code", { class: "text-white" }, JSON.stringify(values, null, 2))),
  })
}

                <Form v-slot="{ handleSubmit }" as="" keep-values :validation-schema="formSchema">
                    <Dialog>
                        <DialogTrigger as-child>
                            <Button variant="outline">
                                +
                            </Button>
                        </DialogTrigger>
                        <DialogContent class="sm:max-w-[425px]">
                            <DialogHeader>
                                <DialogTitle>Add income</DialogTitle>
                                <DialogDescription>
                                    Add income to your account
                                </DialogDescription>
                            </DialogHeader>

                            <form id="dialogForm" @submit="handleSubmit($event, onSubmit)">
                                <FormField v-slot="{ componentField }" name="account">
                                    <FormItem>
                                        <FormLabel>Account</FormLabel>
                                        <FormControl>
                                            <Input type="text" placeholder="Cash" v-bind="componentField" />
                                        </FormControl>
                                        <FormDescription>
                                            This will be type of your account.
                                        </FormDescription>
                                        <FormMessage />
                                    </FormItem>
                                </FormField>

                                <FormField v-slot="{ componentField }" name="amount">
                                    <FormItem>
                                        <FormLabel>Amount</FormLabel>
                                        <FormControl>
                                            <Input type="text" placeholder="2,000" v-bind="componentField" />
                                        </FormControl>
                                        <FormDescription>
                                            This will be added to your account.
                                        </FormDescription>
                                        <FormMessage />
                                    </FormItem>
                                </FormField>
                            </form>

                            <DialogFooter>
                                <Button type="submit" form="dialogForm">
                                    Save changes
                                </Button>
                            </DialogFooter>
                        </DialogContent>
                    </Dialog>
                </Form> -->
<!-- FORM -->